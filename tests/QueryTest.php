<?php

class QueryTest extends PHPUnit_Framework_TestCase {

    public function testSubMethod() {

        $stub = $this->getMockBuilder('Query')
                     ->getMock();

        $stub->method("newMoney")->willReturn(true);
        $this->assertTrue($stub->newMoney());
        $this->assertNull($stub->oldMoney());

        $stub1 = $this->getMockBuilder('Query')
                     ->getMock();
        $stub1->expects($this->any())->method('newMoney')->willReturn(true);
        $this->assertTrue($stub1->newMoney());
        $this->assertNull($stub1->oldMoney());

        $stub2 = $this->getMockBuilder('Query')->setMethods(["newMoney"])
                     ->getMock();
        $stub2->expects($this->any())->method('newMoney')->willReturn(true);
        $this->assertTrue($stub2->newMoney());
        $this->assertEquals($stub2->oldMoney(), 20);

        $stub3 = $this->getMockBuilder("Query")->disableOriginalConstructor()->setMethods(["newMoney"])
                ->getMock();
        $stub3->method("newMoney")->willReturn(true);
        $this->assertTrue($stub3->newMoney());
        $this->assertEquals($stub3->oldMoney(), 15);
    }

    public function testSubMap() {
        $map = array(array(1,2,3),array(2,3,4));
        $stub = $this->getMockBuilder('Query')
                    ->getMock();
        $stub->method("moneyAll")->will($this->returnValueMap($map));
        $this->assertEquals($stub->moneyAll(1,2), 3);
        $this->assertEquals($stub->moneyAll(2,3), 4);
    }

    public function testWillParram() {
        $stub = $this->getMockBuilder('Query')
                    ->getMock();
        $stub->expects($this->exactly(1))
                 ->method('run')
                 ->with($this->equalTo(2));
        $stub->run(2);
    }
}