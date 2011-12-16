<?php
/**
 * @Author  Maxime Teneur maxime.teneur@lanetscouade.com
 * Date: 16/12/11
 * Time: 12:22
 */
namespace Vaporization;
use Buzz\Browser;

class Connexion
{

    const urlService = "https://www.google.com/accounts/ClientLogin";

    /**
     * @param \Buzz\Browser|null $browser
     * @param array|null $config
     */
    function __construct(Browser $browser = null, Array $config = null)
    {
        $this->browser = $browser;
        $this->configure($config);
        $this->token = $this->getToken();
    }

    /**
     * @param \Buzz\Browser $browser
     */
    public function setBrowser(Browser $browser)
    {
        $this->browser = $browser;
    }

    /**
     * @param array $config
     */
    public function configure(Array $config)
    {
        $this->username = $config['username'];
        $this->password = $config['password'];

    }

    /**
     * @return \Buzz\Message\Response
     */
    public function getToken()
    {
        $res = $this->browser->post(self::urlService, array(), "Email=" . $this->username . "&Passwd=" . $this->password . "&service=fusiontables&accountType=GOOGLE");
        return $res->getContent();

    }

}