# Primes

### Prime number operations

## Installation

```
composer require joaofigueira/primes
```

## Usage

#### Check if a number is prime
```
$number = new Primes(5);
if ($number->iPrime()){
	// do stuff
}
```

#### Check several numbers for primes

```
$numbers = new Primes([4,5,6]);
if ($numbers[5]['isPrime']){
	// do stuff
}
```

#### List factors of one or more numbers

```
$number = new Primes;
$number->checkIf(4)->isPrime();
print_r($number->showFactors());
// [4,2,1]
```

#### Count the factors

```
$number = new Primes;
$number->checkIf(4)->isPrime();
echo $number->countFactors();
// 3
```

#### List prime numbers in an interval

```
$primes = new Primes;
print_r($primes->giveMePrimesBetween(1,10));
// [2,3,5,7]
```

#### Return the result in json format

```
$number = new Primes;
$number->checkIf(4)->isPrime();
echo $number->showFactors()->asJson();
```