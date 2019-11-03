<?php

namespace Shailendra\Package;

use Faker\Generator;


Class Package
{
	public function __construct()
	{
		echo "hi";die;
	}
	public function test()
	{
		echo "hi";die;
		$faker = Faker\Factory::create();
		echo $faker->name;
	}
}