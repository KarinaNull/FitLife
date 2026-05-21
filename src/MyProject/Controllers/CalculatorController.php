<?php

declare(strict_types=1);

namespace MyProject\Controllers;

use MyProject\View;

class CalculatorController
{
    private View $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function index(): void
    {
        $this->view->render('calculator/index', [
            'title' => 'Калькулятор ИМТ и калорий',
        ]);
    }

    public function calculate(): void
    {
        $weight = (float) ($_GET['weight'] ?? $_POST['weight'] ?? 0);
        $height = (float) ($_GET['height'] ?? $_POST['height'] ?? 0);
        $age = (int) ($_GET['age'] ?? $_POST['age'] ?? 0);
        $gender = $_GET['gender'] ?? $_POST['gender'] ?? 'male';
        $activity = (float) ($_GET['activity'] ?? $_POST['activity'] ?? 1.2);

        $result = null;
        $error = null;

        if ($weight > 0 && $height > 0 && $age > 0) {
            $heightM = $height / 100;
            $bmi = round($weight / ($heightM * $heightM), 1);
            $bmiCategory = $this->bmiCategory($bmi);

            $bmr = $gender === 'female'
                ? 447.6 + (9.2 * $weight) + (3.1 * $height) - (4.3 * $age)
                : 88.36 + (13.4 * $weight) + (4.8 * $height) - (5.7 * $age);
            $calories = (int) round($bmr * $activity);

            $result = [
                'bmi' => $bmi,
                'bmi_category' => $bmiCategory,
                'calories' => $calories,
                'bmr' => (int) round($bmr),
            ];
        } else {
            $error = 'Заполните вес, рост и возраст положительными числами.';
        }

        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

        if ($isAjax) {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['result' => $result, 'error' => $error]);
            exit;
        }

        $this->view->render('calculator/index', [
            'title' => 'Калькулятор ИМТ и калорий',
            'input' => compact('weight', 'height', 'age', 'gender', 'activity'),
            'result' => $result,
            'error' => $error,
        ]);
    }

    private function bmiCategory(float $bmi): string
    {
        if ($bmi < 18.5) {
            return 'Недостаточный вес';
        }
        if ($bmi < 25) {
            return 'Норма';
        }
        if ($bmi < 30) {
            return 'Избыточный вес';
        }

        return 'Ожирение';
    }
}
