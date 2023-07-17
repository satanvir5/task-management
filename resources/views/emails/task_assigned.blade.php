{{-- <x-mail::message>
# Introduction

The body of your message.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message> --}}

@component('mail::message')
    # Task Assigned

    Hi {{ $task->user->name }},

    You have been assigned a new task:

    Title: {{ $task->title }}
    Description: {{ $task->description }}
    Deadline: {{ $task->deadline }}

    Thanks,
    Task Management System
@endcomponent
