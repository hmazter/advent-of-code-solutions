
year=$1
day=$2

mkdir -p $year/day$day

cp dayExample/day.php "$year/day${day}/day${day}.php"
cp dayExample/DayTest.php "$year/day${day}/Day${day}Test.php"
cp dayExample/functions.php "$year/day${day}/functions.php"

sed -i '' "s/DayTest/Day${day}Test/g" "$year/day${day}/Day${day}Test.php"