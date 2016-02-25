<?php
class Test {
	static public $list;
	static public function setList($list) {
		self::$list = $list;
	}
}

$queue = new SplQueue();
$queue->enqueue('X');
$queue->enqueue('Y');
$queue->enqueue('Z');
var_dump($queue);
$queue->push('XX');
var_dump($queue);
var_dump($queue->pop());
var_dump($queue);
$queue->rewind();
var_dump($queue->current());

echo '<hr/>';

$stack = new SplStack();
var_dump($stack);
$stack->push('A');
$stack->push('B');
$stack->push(3);
$stack->unshift('D');
var_dump($stack);

$stack->rewind();
var_dump($stack->current());
$stack->next();
var_dump($stack->current());
$stack->prev();
var_dump($stack->current());
echo '<hr/>';

$list = new SplDoublyLinkedList();
$list->push(1);
$list->push(2);
$list->push(3);
$list->unshift('a');
var_dump($list);
var_dump($list->offsetExists(10));
$list->rewind();
var_dump($list->current());

$list->next();
var_dump($list->current());
$list->prev();
var_dump($list->current());
//Test::setList($list);
//Test::$list->rewind();
//var_dump(Test::$list->current());
//var_dump(Test::$list->next());

