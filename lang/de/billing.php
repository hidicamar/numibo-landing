<?php

declare(strict_types=1);

return [
    'pricing' => [
        'title' => 'Wähle deinen Tarif',
        'monthly' => 'Monatlich',
        'yearly' => 'Jährlich',
        'per_month' => '/ Monat',
        'per_year' => '/ Jahr',
        'trial_notice' => 'Jeder Tarif beginnt mit einer :days-tägigen kostenlosen Testphase mit :count Aufgaben-Generierungen.',
    ],

    'plans' => [
        'starter' => [
            'name' => 'Starter',
            'description' => 'Alles, was du brauchst, um mit deinen Kindern Mathe zu üben.',
            'features' => [
                'Unbegrenzte Arbeitsblatt-Erstellung',
                'Alle Übungstypen für Klasse 1–5',
                'Interaktives Online-Lösen',
                'Druckbare PDF-Arbeitsblätter mit Lösungen',
            ],
        ],
        'premium' => [
            'name' => 'Premium',
            'description' => 'Alles aus Starter, plus voller Einblick in den Übungsfortschritt.',
            'features' => [
                'Alles aus Starter',
                'Übungsverlauf',
                'Versuchsstatistiken und Fortschritt',
            ],
        ],
    ],
];
