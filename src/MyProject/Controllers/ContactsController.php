<?php

declare(strict_types=1);

namespace MyProject\Controllers;

use MyProject\Models\Contact;
use MyProject\View;

class ContactsController
{
    private View $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function index(): void
    {
        $this->view->render('contacts/index', [
            'title' => 'Записная книжка тренеров',
            'contacts' => Contact::findAll('last_name ASC'),
        ]);
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contact = $this->buildFromPost(new Contact());
            $contact->save();
            header('Location: /contacts');
            exit;
        }

        $this->view->render('contacts/form', [
            'title' => 'Добавление контакта',
            'contact' => null,
            'action' => '/contacts/create',
        ]);
    }

    public function edit(string $id): void
    {
        $contact = Contact::findById((int) $id);
        if ($contact === null) {
            http_response_code(404);
            $this->view->render('errors/404', ['title' => 'Контакт не найден']);

            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contact = $this->buildFromPost($contact);
            $contact->save();
            header('Location: /contacts');
            exit;
        }

        $this->view->render('contacts/form', [
            'title' => 'Редактирование контакта',
            'contact' => $contact,
            'action' => '/contacts/' . $contact->id . '/edit',
        ]);
    }

    public function delete(string $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contact = Contact::findById((int) $id);
            $contact?->delete();
        }

        header('Location: /contacts');
        exit;
    }

    private function buildFromPost(Contact $contact): Contact
    {
        $contact->last_name = trim($_POST['last_name'] ?? '');
        $contact->first_name = trim($_POST['first_name'] ?? '');
        $contact->middle_name = trim($_POST['middle_name'] ?? '');
        $contact->gender = $_POST['gender'] ?? 'male';
        $contact->birth_date = $_POST['birth_date'] ?? '';
        $contact->phone = trim($_POST['phone'] ?? '');
        $contact->address = trim($_POST['address'] ?? '');
        $contact->email = trim($_POST['email'] ?? '');
        $contact->comment = trim($_POST['comment'] ?? '');

        return $contact;
    }
}
