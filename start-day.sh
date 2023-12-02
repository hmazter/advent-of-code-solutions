source .env

year=$1
day=$2

mkdir -p $year/day$day

# Copy files
cp dayExample/day.php "$year/day${day}/day${day}.php"
cp dayExample/DayTest.php "$year/day${day}/Day${day}Test.php"
cp dayExample/functions.php "$year/day${day}/functions.php"

# Update test class name
sed -i '' "s/DayTest/Day${day}Test/g" "$year/day${day}/Day${day}Test.php"

# download input
curl "https://adventofcode.com/${year}/day/${day}/input" \
  -H "cookie: session=${AOC_SESSION}" \
  -o "$year/day${day}/input"

# open files
pstorm "$year/day${day}/functions.php"
pstorm "$year/day${day}/Day${day}Test.php"