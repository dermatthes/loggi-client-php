<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 8/2/17
 * Time: 5:06 AM
 */

namespace Rudl\Client;


class RudlClient
{

    private static $sInstance = null;

    private $mSock = null;
    private $mServerIp;
    private $mServerPort;
    private $mSysId;
    private $mAccountId = null;

    private $mStartupRu = null;

    private $mStartTime = null;

    private $mAnonymizer = [];

    public function __construct($logIp, $logPort=62111)
    {
        $this->mStartupRu = getrusage(); // Collect the startup RU-Usage (To prevent double-counting when apache keepalive is switched on)
        self::$sInstance = $this;
        $this->mSock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        $this->mServerIp = $logIp;
        $this->mServerPort = $logPort;
        $this->mStartTime = microtime(true);
    }


    public function setSysId ($id)
    {
        $this->mSysId = $id;
    }

    public function setAccountId ($id)
    {
        $this->mAccountId = $id;
    }

    public function addAnonymizer ($preg, $replace)
    {
        $this->mAnonymizer[] = [$preg, $replace];
    }

    public function registerResourceLogging ()
    {
        register_shutdown_function(function () {
            $ru = getrusage();
            $url = "//" . @$_SERVER["HTTP_HOST"] . @$_SERVER["REQUEST_URI"];
            foreach ($this->mAnonymizer as $cur) {
                $url = preg_replace($cur[0], $cur[1], $url);
            }
            $rr = [
                $this->mSysId,
                gethostname(),
                $this->mAccountId,
                @$_SERVER["HTTP_X_FORWARDED_FOR"],
                memory_get_peak_usage(),
                ($ru["ru_utime.tv_sec"] + ($ru["ru_utime.tv_usec"] * 0.000001)) - ($this->mStartupRu["ru_utime.tv_sec"] + ($this->mStartupRu["ru_utime.tv_usec"] * 0.000001)) + 0.001,
                ($ru["ru_stime.tv_sec"] + ($ru["ru_stime.tv_usec"] * 0.000001)) - ($this->mStartupRu["ru_stime.tv_sec"] + ($this->mStartupRu["ru_stime.tv_usec"] * 0.000001)) + 0.001,
                $url,
                (microtime(true) - $this->mStartTime)
            ];
            $msg = "G11:" . json_encode($rr);
            socket_sendto($this->mSock, $msg, strlen($msg), 0, $this->mServerIp, $this->mServerPort);
        });
    }

    /**
     * @param $logHost
     * @param int $logPort
     * @return RudlClient
     */
    public static function Init($logHost, $logPort=62111)
    {
        if (self::$sInstance !== null)
            throw new \InvalidArgumentException("RudlClient::Init(): Rudl was already initialized.");
        return new self($logHost, $logPort);
    }

    /**
     * @return null|RudlClient
     */
    public static function Get()
    {
        if (self::$sInstance === null)
            throw new \InvalidArgumentException("RudlClient is not initialized. Call RudlClient::Init() before.");
        return self::$sInstance;
    }

}