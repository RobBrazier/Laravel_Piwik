<?php

namespace RobBrazier\Piwik\Module;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophet;
use RobBrazier\Piwik\Repository\RequestRepository;
use RobBrazier\Piwik\Request\RequestOptions;

class UsersManagerModuleTest extends TestCase
{
    /**
     * @var Prophet
     */
    private $prophet;

    private $request;

    /**
     * @var UsersManagerModule
     */
    private $usersManager;

    /**
     * @var RequestOptions
     */
    private $requestOptions;

    /**
     * @var string
     */
    private $expectedResponse;

    public function setUp(): void
    {
        $this->prophet = new Prophet();
        $this->request = $this->prophet->prophesize(RequestRepository::class);
        $this->usersManager = new UsersManagerModule($this->request->reveal());
        $this->requestOptions = new RequestOptions();
        $this->requestOptions
            ->usePeriod(true)
            ->useSiteId(true)
            ->useFormat(true)
            ->useTokenAuth(true);
        $this->expectedResponse = 'foo';
    }

    public function testGetTokenAuth()
    {
        $userLogin = 'user';
        $md5Password = md5('password');
        $this->requestOptions
            ->useSiteId(false)
            ->usePeriod(false)
            ->setArguments([
                'userLogin' => $userLogin,
                'md5Password' => $md5Password,
            ])
            ->setMethod('UsersManager.getTokenAuth');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->usersManager->getTokenAuth($userLogin, $md5Password);
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testSetUserAccess()
    {
        $userLogin = 'user';
        $access = 'view';
        $idSites = [1];
        $this->requestOptions
            ->useSiteId(false)
            ->usePeriod(false)
            ->setArguments([
                'userLogin' => $userLogin,
                'access' => $access,
                'idSites' => $idSites,
            ])
            ->setMethod('UsersManager.setUserAccess');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->usersManager->setUserAccess($userLogin, $access, $idSites);
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testAddUser()
    {
        $userLogin = 'user';
        $password = 'password';
        $email = 'user@email.com';
        $this->requestOptions
            ->useSiteId(false)
            ->usePeriod(false)
            ->setArguments([
                'userLogin' => $userLogin,
                'password' => $password,
                'email' => $email,
            ])
            ->setMethod('UsersManager.addUser');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->usersManager->addUser($userLogin, $password, $email);
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testAddUserWithAlias()
    {
        $userLogin = 'user';
        $password = 'password';
        $email = 'user@email.com';
        $alias = 'user1';
        $this->requestOptions
            ->useSiteId(false)
            ->usePeriod(false)
            ->setArguments([
                'userLogin' => $userLogin,
                'password' => $password,
                'email' => $email,
                'alias' => $alias,
            ])
            ->setMethod('UsersManager.addUser');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->usersManager->addUser($userLogin, $password, $email, $alias);
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testAddUserWithInitialSiteId()
    {
        $userLogin = 'user';
        $password = 'password';
        $email = 'user@email.com';
        $initialIdSite = '7';
        $this->requestOptions
            ->useSiteId(false)
            ->usePeriod(false)
            ->setArguments([
                'userLogin' => $userLogin,
                'password' => $password,
                'email' => $email,
                'initialIdSite' => $initialIdSite,
            ])
            ->setMethod('UsersManager.addUser');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->usersManager->addUser($userLogin, $password, $email, null, $initialIdSite);
        $this->assertEquals($this->expectedResponse, $response);
    }

    public function testCreateAppSpecificTokenAuth()
    {
        $userLogin = 'user';
        $password = 'password';
        $description = 'description';
        $expireDate = '2020-01-01';
        $expireHours = 0;
        $this->requestOptions
            ->useSiteId(false)
            ->usePeriod(false)
            ->setArguments([
                'userLogin' => $userLogin,
                'passwordConfirmation' => $password,
                'description' => $description,
                'expireDate' => $expireDate,
                'expireHours' => $expireHours
            ])
            ->setMethod('UsersManager.createAppSpecificTokenAuth');
        $this->request->send($this->requestOptions)->willReturn($this->expectedResponse);
        $response = $this->usersManager->createAppSpecificTokenAuth($userLogin, $password, $description, $expireDate, $expireHours);
        $this->assertEquals($this->expectedResponse, $response);
    }
}
