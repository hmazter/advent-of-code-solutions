<?php
declare(strict_types=1);

function build_galaxy(array $input): Galaxy
{
    // create a new Galaxy
    $galaxy = new Galaxy();

    // Add Center of Mass (COM) without parent
    $galaxy->addBody(new Body($galaxy, 'COM', null));

    // Loop over all bodies and add them to the galaxy
    foreach ($input as $item) {
        $galaxy->addBody(Body::createFromItem($galaxy, $item));
    }

    return $galaxy;
}

class Body
{
    private Galaxy $galaxy;
    private string $name;
    private ?string $parentName;
    private ?int $orbitCount = null;

    public function __construct(Galaxy $galaxy, string $name, ?string $parentName)
    {
        $this->galaxy = $galaxy;
        $this->name = $name;
        $this->parentName = $parentName;
    }

    public static function createFromItem(Galaxy $galaxy, string $item): self
    {
        [$parentName, $name] = explode(')', $item);
        return new self($galaxy, $name, $parentName);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOrbitCount(): int
    {
        if ($this->parentName === null) {
            return 0;
        }

        if ($this->orbitCount === null) {
            // only calculate this bodies count once
            $this->orbitCount = $this->galaxy->getBody($this->parentName)->getOrbitCount() + 1;
        }

        return $this->orbitCount;
    }
}

class Galaxy
{
    /** @var Body[] */
    private array $bodies = [];

    public function addBody(Body $body)
    {
        $this->bodies[$body->getName()] = $body;
    }

    public function getBody(string $name): Body
    {
        return $this->bodies[$name];
    }

    public function getTotalOrbitCount(): int
    {
        $total = 0;

        foreach ($this->bodies as $body) {
            $total += $body->getOrbitCount();
        }

        return $total;
    }
}
