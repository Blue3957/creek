# Creek

Operate sequentially on arrays

# Installation

Install me with composer!

`composer require Blue3957/Creek`

# Operation

Create a new `Creek` from an array, manipulate it, then retrieve it!

```php
$users = [
    ['name' => 'Arthur', 'active' => true],
    ['name' => 'Bernard', 'active' => false],
    ['name' => 'Claude', 'active' => true],
];

$activeNames = Creek::from($users)
    ->filter(fn($user) => $user['active'])
    ->map(fn($user) => $user['name'])
    ->toArray(); //["Arthur, Claude"]
```

Supports the following methods:

```php
//manipulation
public function map(Callable $callback): static;
public function filter(?Callable $callback = null): static;
public function usort(Callable $callback): static;
public function uksort(Callable $callback): static;
public function flatten(int $depth = 1): static;

//output
public function toArray(): array;
public function reduce(Callable $callback, mixed $initial = null): mixed;
public function join(?string $separator = null): string;
```
