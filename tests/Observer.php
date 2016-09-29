<?php
class Subject
{
    protected $observers = array();
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function attach(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function doSomething()
    {
        // 做点什么。
        // ...

        // 通知观察者。
        $this->notify('something');
    }

    public function doSomethingBad()
    {
        foreach ($this->observers as $observer) {
            $observer->reportError(42, 'Something bad happened', $this);
        }
    }

    protected function notify($argument)
    {
        foreach ($this->observers as $observer) {
            $observer->update($argument);
        }
    }

    // 其他方法。
}

class Observer
{
    public function update($argument)
    {
        // 做点什么。
    }

    public function reportError($errorCode, $errorMessage, Subject $subject)
    {
        // 做点什么。
    }

    // 其他方法。
}

class SubjectTest extends PHPUnit_Framework_TestCase
{
    public function testObserversAreUpdated()
    {
        // 为 Observer 类建立仿件对象，只模仿 update() 方法。
        $observer = $this->getMockBuilder('Observer')
                         ->setMethods(array('update'))
                         ->getMock();

        // 建立预期状况：update() 方法将会被调用一次，
        // 并且将以字符串 'something' 为参数。
        $observer->expects($this->once())
                 ->method('update')
                 ->with($this->equalTo('something'));

        // 创建 Subject 对象，并将模仿的 Observer 对象连接其上。
        $subject = new Subject('My subject');
        $subject->attach($observer);

        // 在 $subject 对象上调用 doSomething() 方法，
        // 预期将以字符串 'something' 为参数调用 
        // Observer 仿件对象的 update() 方法。
        $subject->doSomething();
    }
}