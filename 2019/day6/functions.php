<?php
declare(strict_types=1);

function build_galaxy(array $input): Galaxy
{
    // create a new Galaxy
    $galaxy = new Galaxy();

    // Loop over all bodies
    // create them if not already exists in the galaxy and add them to the galaxy
    // Connect the orbits
    foreach ($input as $item) {
        [$parentName, $name] = explode(')', $item);

        if (!$galaxy->hasBody($parentName)) {
            $parent = $galaxy->addBody(new Body($parentName));
        } else {
            $parent = $galaxy->getBody($parentName);
        }

        if (!$galaxy->hasBody($name)) {
            $body = $galaxy->addBody(new Body($name));
        } else {
            $body = $galaxy->getBody($name);
        }

        $body->setParent($parent);
        $parent->addChild($body);
    }

    return $galaxy;
}

class Body
{
    private string $name;
    private ?Body $parent = null;
    private array $children = [];
    private int $orbitCountFromStartBody = 0;

    public bool $visited = false;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOrbitCountFromCenter(): int
    {
        if ($this->parent === null) {
            return 0;
        }

        return $this->parent->getOrbitCountFromCenter() + 1;
    }

    public function getOrbitCountFromStartBody(): int
    {
        return $this->orbitCountFromStartBody;
    }

    public function setOrbitCountFromStartBody(int $orbitCount): void
    {
        $this->orbitCountFromStartBody = $orbitCount;
    }

    public function setParent(Body $parent): void
    {
        $this->parent = $parent;
    }

    public function addChild(Body $body): void
    {
        $this->children[] = $body;
    }

    /**
     * @return Body[]
     */
    public function getOrbits(): array
    {
        $orbits = $this->children;
        if ($this->parent) {
            $orbits[] = $this->parent;
        }
        return $orbits;
    }
}

class Galaxy
{
    /** @var Body[] */
    private array $bodies = [];

    public function addBody(Body $body): Body
    {
        $this->bodies[$body->getName()] = $body;
        return $body;
    }

    public function hasBody(string $name): bool
    {
        return isset($this->bodies[$name]);
    }

    public function getBody(string $name): Body
    {
        return $this->bodies[$name];
    }

    public function getTotalOrbitCount(): int
    {
        $total = 0;

        foreach ($this->bodies as $body) {
            $total += $body->getOrbitCountFromCenter();
        }

        return $total;
    }

    public function getDistanceBetween(string $start, string $target): int
    {
        // the queue with bodies to visit
        $queue = new SplQueue();

        // add all orbits from the start node
        $body = $this->getBody($start);
        $body->visited = true;
        foreach ($body->getOrbits() as $orbit) {
            $orbit->setOrbitCountFromStartBody(1);
            $queue->enqueue($orbit);
        }

        while ($queue->count() > 0) {
            /** @var Body $body */
            $body = $queue->dequeue();

            if ($body->visited) {
                // we have been here before
                // this is not the target
                // and all its orbits has already been added to the queue
                continue;
            }

            if ($body->getName() === $target) {
                // we found the target
                // we don't count the orbits for Start and Target themselves, therefore -2
                return $body->getOrbitCountFromStartBody() - 2;
            }

            // mark body as visited
            $body->visited = true;

            // add all orbits from here to queue
            foreach ($body->getOrbits() as $b) {
                $b->setOrbitCountFromStartBody($body->getOrbitCountFromStartBody() + 1);
                $queue->enqueue($b);
            }
        }

        throw new RuntimeException('Did not find target body in this galaxy');
    }
}
