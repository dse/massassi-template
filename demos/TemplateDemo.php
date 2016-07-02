<?php
require_once("../src/Template.php");
date_default_timezone_set("America/New_York");

$body = new Template("TemplateDemo.body.tpl.php");
$body->set("date", date("Y-m-d"));
$body->set("message", "Hello, world!");
$body->set("heading", "Howdy");

$tpl = new Template("TemplateDemo.tpl.php");
$tpl->set("title", "Hello World");
$tpl->set("body", $body);
echo $tpl->fetch();
