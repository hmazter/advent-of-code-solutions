fn count_lanternfish(input: &[usize], days: i32) -> u64 {
    let mut ages: [usize; 9] = [0; 9];

    for age in input {
        ages[age] += 1
    }

    for _i in 0..days {
        ages.rotate_left(1); // move age 0 to new fish as age 8
        ages[6] += ages[8]; // reset fish to age 6
    }

    // count all the fishes
    return ages.iter().sum();
}

fn parse_input(input: &str) -> &[usize] {
    return input
        .split(",")
        .map(|s| s.trim().parse::<usize>().unwrap())
        .collect();
}

fn main() {
    let input = parse_input(include_str!("../input"));

    println!("part 1: {}", count_lanternfish(input, 80));
    println!("part 2: {}", count_lanternfish(input, 256));
}

#[cfg(test)]
mod tests {
    use super::*;

    #[test]
    fn test_parse_input() {
        let input = parse_input("3,4,3,1,2");

        assert_eq!(input, [3, 4, 3, 1, 2]);
    }

    #[test]
    fn solve_part1() {
        let input = parse_input("3,4,3,1,2");

        assert_eq!(count_lanternfish(input, 18), 26);
        assert_eq!(count_lanternfish(input, 80), 5934);
    }

    #[test]
    fn solve_part2() {
        let input = parse_input("3,4,3,1,2");

        assert_eq!(count_lanternfish(input, 256), 26984457539);
    }
}