<?php

use PHPUnit\Framework\TestCase;
use Primes\Primes;

class PrimesTest extends TestCase
{
	/** @test */
	public function does_not_accepts_negative_numbers()
	{
		$this->expectException(Exception::class);
		$number = new Primes(-10);
	}

	/** @test */
	public function does_not_accept_zero()
	{
		$this->expectException(Exception::class);
		$number = new Primes(0);
	}

	/** @test */
	public function does_not_accept_float_numbers()
	{
		$this->expectException(Exception::class);
		$number = new Primes(1.1);
	}

	/** @test */
	public function does_not_accept_strings()
	{
		$this->expectException(Exception::class);
		$number = new Primes('random string...');
	}

	/** @test */
	public function returns_false_if_not_prime()
	{
		$number = new Primes(4);
		$this->assertFalse($number->isPrime());
	}

	/** @test */
	public function returns_true_if_is_prime()
	{
		$number = new Primes(5);
		$this->assertTrue($number->isPrime());
	}	

	/** @test */
	public function works_with_arrays()
	{
		$number = new Primes([4,5]);
		$this->assertEquals($number->arePrimes(), [['number'=>4, 'is_prime'=>false],['number'=>5, 'is_prime'=>true]]);
	}

	/** @test */
	public function alternative_set_primes_method()
	{
		$number = new Primes();
		$this->assertTrue($number->checkIf(5)->isPrime());
		$this->assertFalse($number->checkIf(4)->isPrime());
	}

	/** @test */
	public function alternative_set_primes_array_method()
	{
		$number = new Primes();
		$number->checkIf([4,5]);
		$this->assertEquals($number->arePrimes(), [['number'=>4, 'is_prime'=>false],['number'=>5, 'is_prime'=>true]]);
	}

	/** @test */
	public function output_as_json()
	{
		$number = new Primes;

		$number->checkIf(4)->isPrime();
		$this->assertEquals($number->asJson(),'false');

		$number->checkIf(5)->isPrime();
		$this->assertEquals($number->asJson(),'true');		
	}

	/** @test */
	public function output_array_check_as_json()
	{
		$number = new Primes;

		$number->checkIf([4,5])->arePrimes();
		$this->assertEquals($number->asJson(),'[{"number":4,"is_prime":false},{"number":5,"is_prime":true}]');
	}

	/** @test */
	public function check_if_factors_return_an_array()
	{
		$number = new Primes;

		$number->checkIf(4)->isPrime();
		$this->assertInternalType('array',$number->showFactors());
		$this->assertEquals($number->showFactors(),[4 => [4,2,1]]);

		$number->checkIf([4,5])->arePrimes();
		$this->assertInternalType('array',$number->showFactors());
		$this->assertEquals($number->showFactors(),[4 => [4,2,1], 5 => [5,1]]);
	}

	/** @test */
	public function check_if_factors_work_with_asJson()
	{
		$number = new Primes;

		$number->checkIf(4)->isPrime();
		$number->showFactors();
		$this->assertInternalType('string',$number->asJson());
		$this->assertEquals($number->asJson(),'{"4":[4,2,1]}');

		$number->checkIf([4,5])->arePrimes();
		$number->showFactors();
		$this->assertInternalType('string',$number->asJson());
		$this->assertEquals($number->asJson(),'{"4":[4,2,1],"5":[5,1]}');
	}

	/** @test */
	public function it_returns_the_count_of_the_factors()
	{
		$number = new Primes;

		$number->checkIf(5)->isPrime();
		$this->assertEquals([2],$number->countFactors());

		$number->checkIf([4,5])->arePrimes();
		$this->assertEquals([3,2],$number->countFactors());	
	}	

	/** @test */
	public function check_if_give_me_primes_works()
	{
		$number = new Primes;
		$this->assertEquals([2,3,5,7], $number->giveMePrimesBetween(1,10));
	}
}