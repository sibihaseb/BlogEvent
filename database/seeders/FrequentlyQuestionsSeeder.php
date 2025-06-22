<?php

namespace Database\Seeders;

use App\Models\FrequentlyQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FrequentlyQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $faqData = [
            [
                'question' => 'Is it accessible?',
                'answer' => 'Yes. It adheres to the WAI-ARIA design pattern.',
                'type' => 'about',
                'is_active' => 1,
            ],
            [
                'question' => 'Is it unstyled?',
                'answer' => 'Yes. It`s unstyled by default, giving you freedom over the look and feel.',
                'type' => 'about',
                'is_active' => 1,
            ],

            [
                'question' => 'Can it be animated?',
                'answer' => 'Yes! You can use the transition prop to configure the animation.',
                'type' => 'about',
                'is_active' => 1,
            ],
            [
                'question' => 'Is it accessible?',
                'answer' => 'Yes. It adheres to the WAI-ARIA design pattern.',
                'type' => 'prayer',
                'is_active' => 1,
            ],
            [
                'question' => 'Is it unstyled?',
                'answer' => 'Yes. It`s unstyled by default, giving you freedom over the look and feel.',
                'type' => 'prayer',
                'is_active' => 0,
            ],
            [
                'question' => 'Can it be animated?',
                'answer' => 'Yes! You can use the transition prop to configure the animation.',
                'type' => 'prayer',
                'is_active' => 0,
            ],
            [
                'question' => 'Is it accessible?',
                'answer' => 'Yes. It adheres to the WAI-ARIA design pattern.',
                'type' => 'contact',
                'is_active' => 1,
            ],
            [
                'question' => 'Is it unstyled?',
                'answer' => 'Yes. It`s unstyled by default, giving you freedom over the look and feel.',
                'type' => 'contact',
                'is_active' => 0,
            ],
            [
                'question' => 'Can it be animated?',
                'answer' => 'Yes! You can use the transition prop to configure the animation.',
                'type' => 'contact',
                'is_active' => 0,
            ],
        ];

        foreach ($faqData as $faq) {
            FrequentlyQuestion::create($faq);
        }
    }
}
