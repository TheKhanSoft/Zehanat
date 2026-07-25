<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'What is Zehanat?',
                'answer' => 'Zehanat is a leading initiative focusing on Artificial Intelligence in Education. We aim to revolutionize the educational landscape by integrating advanced AI tools and methodologies into schools and institutions. Our goal is to empower educators and students alike.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'Who can join Zehanat?',
                'answer' => 'Zehanat welcomes a diverse range of participants. This includes individuals, educational institutions, industry partners, and students. Anyone passionate about the intersection of AI and education can find a place within our community.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Is membership free?',
                'answer' => 'Basic membership for students and educators is completely free. We also offer premium tiers for institutions and industry partners which provide additional benefits, resources, and dedicated support to help implement AI strategies.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'question' => 'What are the Six Pillars?',
                'answer' => 'The Six Pillars are the foundational principles of Zehanat’s approach to AI in education. They include AI Literacy, Ethical AI, Adaptive Learning, Teacher Empowerment, Data Privacy, and Future Readiness. These pillars guide all our programs and partnerships.',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'question' => 'How does Zehanat help schools?',
                'answer' => 'Zehanat provides schools with comprehensive frameworks to integrate AI. We offer teacher training, curriculum development assistance, and access to cutting-edge AI educational tools. Furthermore, we help schools develop ethical guidelines for AI usage.',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'question' => 'Can industry partners join?',
                'answer' => 'Yes, industry partners are a crucial part of our ecosystem. Tech companies, publishers, and educational service providers can join Zehanat to collaborate on research, pilot new tools, and connect directly with educational institutions.',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'question' => 'Where is Zehanat based?',
                'answer' => 'Zehanat operates globally through our online platform, but our headquarters are located in a central tech hub. We have regional chapters and representatives in multiple countries to provide localized support to our member institutions.',
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'question' => 'How do I register my institution?',
                'answer' => 'You can register your institution by filling out the membership form on our website and selecting "Institution" as the category. Once submitted, our team will review your application and contact you within a few business days to complete the onboarding process.',
                'sort_order' => 8,
                'is_active' => true,
            ],
            [
                'question' => 'What events does Zehanat organize?',
                'answer' => 'Zehanat organizes a variety of events including annual AI in Education conferences, monthly webinars with industry experts, and hands-on workshops for educators. We also host hackathons and innovation challenges for students.',
                'sort_order' => 9,
                'is_active' => true,
            ],
            [
                'question' => 'How can I contact Zehanat?',
                'answer' => 'You can reach out to us using the contact form on our website. Alternatively, you can email our support team directly at support@zehanat.org. We aim to respond to all inquiries within 24 to 48 hours.',
                'sort_order' => 10,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
