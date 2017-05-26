<?php
namespace Primes;

class Primes implements PrimesInterface
{
	private $number,
			$result,
			$factors = [];

	public function __construct($number = null)
	{
		if (!is_null($number))
			$this->setNumber($number);
	}

	public function isPrime()
	{
		if($this->checkIfIsPrime($this->number)){
			$this->result = true;
		} else {
			$this->result = false;
		}

		return $this->result;
	}

	public function arePrimes()
	{
		foreach($this->number as $number){
			$this->result[] = ['number' => $number, 'is_prime' => ($this->checkIfIsPrime($number)) ? true : false];
		}

		return $this->result;
	}

	public function checkIf($number)
	{
		//discard previous results and factors;
		$this->factors = array();
		$this->result  = array();

		$this->number = $number;
		return $this;
	}

	public function asJson()
	{
		return json_encode($this->result);
	}

	public function showFactors()
	{
		$this->result = $this->factors;
		return $this->factors;
	}

	public function countFactors()
	{
		foreach($this->factors as $factors){
			$count[] = count($factors);		
		}
		return $count;
	}

	public function giveMePrimesBetween($from, $to)
	{
		$result = [];
		for($i=$from;$i<=$to;$i++){
			if ($this->checkIfIsPrime($i)){
				$result[] = $i;
			}
		}
		return $result;
	}

	private function sanitize($number){
		if (is_string($number)){
			throw new \Exception('Number must be an integer. String provided.');
		}

		if ($number <= 0){
			throw new \Exception('Number must be greater or equal to 1.');
		}

		if (!is_int($number)){
			throw new \Exception('Number must be an integer.');
		}		

		return true;
	}

	private function checkIfIsPrime($number)
	{
		$factors = 0;

		for($i = 1; $i <= $number; $i++){
			if(is_int($number/$i)){
				$factors++;
				$this->factors[$number][] = $number/$i;
			}
		}

		if($factors == 2){
			return true;
		}

		return false;		
	}

	private function setNumber($number)
	{
		if(is_array($number)){
			foreach($number as $val){
				$this->sanitize($val);
			}
		} else {
			$this->sanitize($number);	
		}

		$this->number = $number;

		return true;
	}
}