<?php
require_once 'UserDao.php';
require_once 'AccountDao.php';
require_once 'BudgetDao.php';
require_once 'CategoryDao.php';
require_once 'ExpenseDao.php';

echo "<h2>DAO Layer Test</h2>";


$uniqueId = time();


echo "<h3>UserDao Test</h3>";
$userDao = new UserDao();

$username = "Alice_$uniqueId";
$email = "alice_$uniqueId@example.com";

$userDao->insert([
    'username' => $username,
    'email' => $email,
    'password' => '12345'
]);
echo "Inserted User: $username ($email)<br>";


$users = $userDao->getAll();
echo "<pre>All Users:\n";
print_r($users);
echo "</pre>";


$userDao->update($users[0]['id'], ['username' => $username . "_Updated"]);
echo "Updated User ID {$users[0]['id']} username<br>";


echo "<h3>CategoryDao Test</h3>";
$categoryDao = new CategoryDao();
$categoryDao->insert(['name' => "Food_$uniqueId"]);
$cat = $categoryDao->getByName("Food_$uniqueId");

$categories = $categoryDao->getAll();
echo "<pre>All Categories:\n";
print_r($categories);
echo "</pre>";


echo "<h3>AccountDao Test</h3>";
$accountDao = new AccountDao();
$accountDao->insert([
    'user_id' => $users[0]['id'],
    'name' => 'Main Account',   
    'balance' => 1000
]);
$accounts = $accountDao->getAll();
echo "<pre>All Accounts:\n";
print_r($accounts);
echo "</pre>";


echo "<h3>BudgetDao Test</h3>";
$budgetDao = new BudgetDao();
$budgetDao->insert([
    'user_id' => $users[0]['id'],
    'category_id' => $cat['id'], 
    'amount' => 500
]);
$budgets = $budgetDao->getAll();
echo "<pre>All Budgets:\n";
print_r($budgets);
echo "</pre>";


echo "<h3>ExpenseDao Test</h3>";
$expenseDao = new ExpenseDao();
$expenseDao->insert([
    'user_id' => $users[0]['id'],
    'category_id' => $cat['id'],
    'amount' => 50,
    'description' => 'Lunch'
]);
$expenses = $expenseDao->getAll();
echo "<pre>All Expenses:\n";
print_r($expenses);
echo "</pre>";


$userExpenses = $expenseDao->getByUserId($users[0]['id']);
echo "<pre>Expenses by User ID {$users[0]['id']}:\n";
print_r($userExpenses);
echo "</pre>";


$catExpenses = $expenseDao->getByCategory($cat['id']);
echo "<pre>Expenses in Category ID {$cat['id']}:\n";
print_r($catExpenses);
echo "</pre>";

?>



