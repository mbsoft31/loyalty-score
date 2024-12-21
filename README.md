Here’s how you can represent the loyalty program behaviors using PHP classes, interfaces, and traits in a clean and extensible manner. The idea is to encapsulate various behaviors (e.g., earning points, redeeming points, validating rules) into reusable components.

---

### **Key Concepts**

1. **Base Classes and Interfaces**:
    - Define interfaces for common behaviors like earning and redeeming points.
    - Use abstract classes to provide shared functionality.

2. **Traits**:
    - Encapsulate reusable logic, such as category-based calculations or date validations.

3. **Concrete Implementations**:
    - Create classes for specific reward systems (e.g., cashback, tiered rewards).

---

### **1. Base Interfaces**

**`EarningPointsInterface`**:
```php
interface EarningPointsInterface
{
    public function calculatePoints(float $amount, array $context = []): int;
}
```

**`RedeemingPointsInterface`**:
```php
interface RedeemingPointsInterface
{
    public function calculateRedemption(int $points, array $context = []): float;
    public function canRedeem(int $points): bool;
}
```

---

### **2. Traits**

**Category-Based Points Calculation**:
```php
trait CategoryPointsTrait
{
    protected function calculateCategoryPoints(float $amount, string $category, array $categoryRules): int
    {
        if (isset($categoryRules[$category])) {
            return $amount * $categoryRules[$category];
        }
        return 0; // No points for this category
    }
}
```

**Date Validation**:
```php
trait DateValidationTrait
{
    protected function isWithinValidity(string $startDate, string $endDate): bool
    {
        $now = new DateTime();
        return $now >= new DateTime($startDate) && $now <= new DateTime($endDate);
    }
}
```

---

### **3. Abstract Base Class**

**`LoyaltyProgram`**:
```php
abstract class LoyaltyProgram
{
    protected array $rules;

    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    public function isActive(): bool
    {
        if (isset($this->rules['validity'])) {
            return $this->isWithinValidity(
                $this->rules['validity']['start_date'],
                $this->rules['validity']['end_date']
            );
        }
        return true;
    }

    use DateValidationTrait;
}
```

---

### **4. Concrete Classes**

#### **Points-Based Program**
```php
class PointsBasedProgram extends LoyaltyProgram implements EarningPointsInterface, RedeemingPointsInterface
{
    public function calculatePoints(float $amount, array $context = []): int
    {
        return $amount * ($this->rules['earn_points']['per_dollar_spent'] ?? 0);
    }

    public function calculateRedemption(int $points, array $context = []): float
    {
        if (!$this->canRedeem($points)) {
            return 0.0;
        }

        $rate = $this->rules['redeem_points']['per_dollar_discount'] ?? 100;
        return $points / $rate;
    }

    public function canRedeem(int $points): bool
    {
        $minPoints = $this->rules['redeem_points']['minimum_points_required'] ?? 0;
        return $points >= $minPoints;
    }
}
```

#### **Category-Specific Program**
```php
class CategorySpecificProgram extends LoyaltyProgram implements EarningPointsInterface
{
    use CategoryPointsTrait;

    public function calculatePoints(float $amount, array $context = []): int
    {
        $category = $context['category'] ?? 'default';
        $categoryRules = $this->rules['earn_points']['categories'] ?? [];

        return $this->calculateCategoryPoints($amount, $category, $categoryRules) +
            ($amount * ($this->rules['earn_points']['per_dollar_spent'] ?? 0));
    }
}
```

#### **Cashback Program**
```php
class CashbackProgram extends LoyaltyProgram implements EarningPointsInterface, RedeemingPointsInterface
{
    public function calculatePoints(float $amount, array $context = []): int
    {
        return $amount * ($this->rules['earn_points']['per_dollar_spent'] ?? 0);
    }

    public function calculateRedemption(int $points, array $context = []): float
    {
        $conversionRate = $this->rules['redeem_points']['conversion_rate']['points_per_dollar_cashback'] ?? 100;
        return $points / $conversionRate;
    }

    public function canRedeem(int $points): bool
    {
        $minPoints = $this->rules['redeem_points']['minimum_points_required'] ?? 0;
        return $points >= $minPoints;
    }
}
```

---

### **5. Using the Classes**

#### **Example 1: Points-Based Program**
```php
$rules = [
    "earn_points" => ["per_dollar_spent" => 10],
    "redeem_points" => ["per_dollar_discount" => 100, "minimum_points_required" => 500],
    "validity" => ["start_date" => "2024-01-01", "end_date" => "2024-12-31"]
];

$program = new PointsBasedProgram($rules);

$earnedPoints = $program->calculatePoints(100); // Earned 1000 points for $100
$redeemableValue = $program->calculateRedemption(1000); // $10 discount
```

#### **Example 2: Category-Specific Program**
```php
$rules = [
    "earn_points" => [
        "per_dollar_spent" => 5,
        "categories" => ["electronics" => 15, "groceries" => 10]
    ],
    "validity" => ["start_date" => "2024-01-01", "end_date" => "2024-12-31"]
];

$program = new CategorySpecificProgram($rules);

$earnedPoints = $program->calculatePoints(100, ["category" => "electronics"]); // 1500 points for electronics
```

#### **Example 3: Cashback Program**
```php
$rules = [
    "earn_points" => ["per_dollar_spent" => 2],
    "redeem_points" => ["conversion_rate" => ["points_per_dollar_cashback" => 100], "minimum_points_required" => 1000],
    "validity" => ["start_date" => "2024-01-01", "end_date" => "2024-12-31"]
];

$program = new CashbackProgram($rules);

$earnedPoints = $program->calculatePoints(100); // Earned 200 points for $100
$cashback = $program->calculateRedemption(1000); // $10 cashback
```

---

This approach keeps your code clean, extensible, and encapsulated. You can easily add more program types or rules without modifying existing classes. Would you like additional enhancements, such as event-based rewards?
