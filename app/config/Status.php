// src/Config/Status.php
namespace App\Config;

enum Status: string
{
case NotStarted = 'Task not started';
case OnGoing = 'On going Task';
case Finished = 'Task Finished';
}