<?php
namespace Primes;

interface PrimesInterface
{
	/**
	* @return bool
	*/
	public function isPrime();

	/**
	* @return int[]
	*/
	public function arePrimes();

	/**
	* @param int | array $number
	*
	* @return Primes
	*/
	public function checkIf($number);

	/**
	* @return string
	*/
	public function asJson();

	/**
	* @return int[]
	*/
	public function showFactors();

	/**
	* @return int[]
	*/
	public function countFactors();

	/**
	* @param int $from
	* @param int $to
	*
	* @return int[]
	*/
	public function giveMePrimesBetween($from, $to);
}