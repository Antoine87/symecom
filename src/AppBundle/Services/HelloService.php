<?php

namespace AppBundle\Services;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class HelloService
{
    /**
     * @var RequestStack
     */
    private $request;

    /**
     * HelloService constructor.
     * @param RequestStack $request
     */
    public function __construct(RequestStack $request)
    {
        $this->request = $request;
    }

    public function sayHello(){
        $currentRequest = $this->request->getCurrentRequest();
        $name = $currentRequest->get("name", "world");
        return "Hello $name";
    }

}