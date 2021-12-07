fn count_lanternfish(mut ages: [u64; 9], days: i32) -> u64 {
    for _i in 0..days {
        ages.rotate_left(1); // move age 0 to new fish as age 8
        ages[6] += ages[8]; // reset fish to age 6
    }

    // count all the fishes
    return ages.iter().sum::<u64>();
}

fn group_ages(input: &str) -> [u64; 9] {
    let mut ages: [u64; 9] = [0; 9];

    input
        .split(",")
        .map(|num| num.trim().parse::<usize>().unwrap())
        .for_each(|age| ages[age] += 1);

    return ages;
}

fn main() {
    let input = group_ages(include_str!("../input"));

    println!("part 1: {}", count_lanternfish(input, 80));
    println!("part 2: {}", count_lanternfish(input, 256));
}

#[cfg(test)]
mod tests {
    use super::*;

    #[test]
    fn test_group_ages() {
        let input = group_ages("3,4,3,1,2");

        assert_eq!(input, [0, 1, 1, 2, 1, 0, 0, 0, 0]);
    }

    #[test]
    fn solve_part1() {
        let input = group_ages("3,4,3,1,2");

        assert_eq!(count_lanternfish(input, 18), 26);
        assert_eq!(count_lanternfish(input, 80), 5934);
    }

    #[test]
    fn solve_part2() {
        let input = group_ages("3,4,3,1,2");

        assert_eq!(count_lanternfish(input, 256), 26984457539);
    }
}