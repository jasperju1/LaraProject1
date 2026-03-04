<?php

class Student
{
    public $name;
    public $age;
    public $grade;

    public function introduce()
    {
        return "Hi, I'm {$this->name}, <br> {$this->age} years old, <br> and I'm in grade {$this->grade} <br>";
    }

    public function study($subject)
    {
        return "{$this->name} is studying " . $subject;
    }
}

$student1 = new Student();
$student1->name = "Jessica";
$student1->age = 18;
$student1->grade = 12;

echo $student1->introduce();
echo $student1->study("laravel");

?>
<br>
<br>
<br>
<?php

class Product
{

    private $name;
    private $price;
    private $stock;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function addStock($amount)
    {
        if ($amount > 0) {
            $this->stock += $amount;
            return true;
        }
    }

    public function purchase($amount)
    { {
            if ($amount <= $this->stock) {
                $this->stock -= $amount;
                return "Purchased:" . $amount;
            }
            return "Insufficient funds";
        }
    }
}

$product = new Product();
$product->setName("Laptop");
$product->setPrice(999.99);
$product->setStock(10);


echo $product->getName() . "<br>";
$product->addStock(5);
echo $product->getStock() . "<br>";
$product->purchase(3);
echo $product->getStock();

?>
<br>
<br>
<br>
<?php

class User
{
    public $name;
    public $email;

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }
}

$user = new User("John Doe", "john@example.com");
echo $user->name . "<br>";
echo $user->email;

?>
<br>
<br>
<br>
<?php

class Product1
{
    public $name;
    public $price;
    public $inStock;

    public function __construct($name, $price, $inStock = true)
    {
        $this->name = $name;
        $this->price = $price;
        $this->inStock = $inStock;
    }
}

$product1 = new Product1("Laptop", 999.99);
$product2 = new Product1("Phone", 599.99, false);

var_dump($product1->inStock); // true
var_dump($product2->inStock); // false

?>
<br>
<br>
<br>
<?php

// (PHP 7 and earlier)
class UserOld
{
    public $name;
    public $email;

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }
}

// PHP 8 way (Constructor Property Promotion)
class UserNew
{
    public function __construct(
        public string $name,
        public string $email,
        private int $age = 18
    ) {}
}

$user = new UserNew("Jane", "jane@example.com", 25);
echo $user->name . "<br>";
echo $user->email;
// echo $user->age; // cant use because private 

?>
<br>
<br>
<br>
<?php

class Book
{
    public function __construct(
        private string $title,
        private string $author,
        private string $year,
        private string $price
    ) {

        $currentYear = (int) date('Y');

        if ($year < 1000 || $year > $currentYear) {
            throw new Exception("Year has to be between 1000 and {$currentYear}.");
        }

        if ($price < 0) {
            throw new Exception("Price has to be positive.");
        }
    }

    public function getInfo()
    {
        return "{$this->title} by {$this->author} ({$this->year}) - {$this->price}";
    }
}

$book = new Book("Clean Code", "Robert C. Martin", 2008, 39.99);
$book1 = new Book("Sexy Women", "Marius Kuul", 2026, 69.99);
echo $book->getInfo() . "<br>";
echo $book1->getInfo() . "<br>";

// $invalidbook = new Book("Old Book", "Author", 500, 10);
// echo $invalidbook->getInfo();

?>
<br>
<br>
<br>
<?php

class Counter
{
    public static $count = 0;
    public $instanceId;

    public function __construct()
    {
        self::$count++;
        $this->instanceId = self::$count;
    }

    public static function getCount()
    {
        return self::$count;
    }
}

$obj1 = new Counter();
$obj2 = new Counter();
$obj3 = new Counter();

echo Counter::$count . "<br>"; // Output: 3
echo Counter::getCount() . "<br>"; // Output: 3
echo $obj1->instanceId . "<br>"; // Output: 1
echo $obj2->instanceId . "<br>"; // Output: 2
?>
<br>
<br>
<br>
<?php

class MathHelper
{
    public static function add($a, $b)
    {
        return $a + $b;
    }

    public static function multiply($a, $b)
    {
        return $a * $b;
    }

    public static function calculateCircleArea($radius)
    {
        return pi() * $radius * $radius;
    }
}

// No need to instantiate the class
echo MathHelper::add(5, 3) . "<br>"; // Output: 8
echo MathHelper::multiply(4, 7) . "<br>"; // Output: 28
echo MathHelper::calculateCircleArea(5) . "<br>"; // Output: 78.539816339745
?>
<br>
<br>
<br>
<?php

class Config
{
    public static $appName = "My Application";
    private static $apiKey = "secret_key_123";

    public static function getAppName()
    {
        return self::$appName;
    }

    public static function getApiKey()
    {
        return self::$apiKey;
    }

    public static function setAppName($name)
    {
        self::$appName = $name;
    }
}

echo Config::$appName; // Direct access: My Application
echo Config::getAppName() . "<br>"; // Via method: My Application
echo Config::getApiKey() . "<br>"; // Access private property via method

Config::setAppName("New App Name");
echo Config::getAppName(); // Output: New App Name

// echo Config::$apiKey; // ERROR: Cannot access private property
?>
<br>
<br>
<br>
<?php

class Validator 
{
    public static $TotalValidations = 0;

    public static function validateEmail($email) {
        self::$TotalValidations++;
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else return false;
    }

    public static function validateAge($age) {
        self::$TotalValidations++;
        if ($age > 0 && $age < 120) {
            return true;
        } else return false;
    }

    public static function validatePassword($password) {
        self::$TotalValidations++;
        if (strlen($password) > 7) {
            return true;
        } else return false;
    }

    public static function getTotalValidations()
    {
        return self::$TotalValidations;
    }
}

echo Validator::validateEmail("test@example.com") . "<br>"; // true
echo Validator::validateEmail("invalid-email") . "<br>"; // false
echo Validator::validateAge(25) . "<br>"; // true
echo Validator::validateAge(150) . "<br>"; // false
echo Validator::validatePassword("secret123") . "<br>"; // true
echo Validator::validatePassword("short") . "<br>"; // false
echo Validator::getTotalValidations(); // 6
?>
<br>
<br>
<br>
<?php

