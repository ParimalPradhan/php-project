<!DOCTYPE html>
<html>
<body>

<?php
class Student {
  public $firstname;
  public $lastname;
  public function __construct($firstname, $lastname) {
    $this->firstname = $firstname;
    $this->lastname = $lastname;
  }
  public function message() {
    return "My student is a " . $this->firstname . " " . $this->lastname . "!";
  }
}

$myStudent = new Student("vinita", "manglani");
echo $myStudent -> message();
/*echo "<br>";
$myCar = new Car("red", "Toyota");
echo $myCar -> message();*/

?>

</body>
</html>
