<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ResearchTitle;
use Illuminate\Database\Seeder;

class ResearchTitleSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all()->keyBy('name');

        // Active research titles (10+)
        $activeTitles = [
            // With photos (5)
            [
                'title' => 'AI-Based Attendance Monitoring System Using Facial Recognition',
                'author_name' => 'Juan Dela Cruz',
                'email' => 'juan.delacruz@ccs.edu',
                'category_id' => $categories['Information Technology']->id,
                'photo' => null, // Will add dummy photo path
            ],
            [
                'title' => 'Web-Based Thesis Repository for CCS with Advanced Search Capabilities',
                'author_name' => 'Maria Santos',
                'email' => 'maria.santos@ccs.edu',
                'category_id' => $categories['Software Engineering']->id,
                'photo' => null,
            ],
            [
                'title' => 'IoT-Based Smart Classroom System for Real-Time Monitoring',
                'author_name' => 'Carlos Miguel',
                'email' => 'carlos.miguel@ccs.edu',
                'category_id' => $categories['Information Technology']->id,
                'photo' => null,
            ],
            [
                'title' => 'Machine Learning Model for Traffic Prediction in Metro Manila',
                'author_name' => 'Ana Garcia',
                'email' => 'ana.garcia@ccs.edu',
                'category_id' => $categories['Computer Science']->id,
                'photo' => null,
            ],
            [
                'title' => 'Cloud-Based ERP System for Small and Medium Enterprises',
                'author_name' => 'Roberto Lopez',
                'email' => 'roberto.lopez@ccs.edu',
                'category_id' => $categories['Software Engineering']->id,
                'photo' => null,
            ],
            // Without photos (5+)
            [
                'title' => 'Blockchain Technology for Secure Document Verification Systems',
                'author_name' => 'Jennifer Torres',
                'email' => 'jennifer.torres@ccs.edu',
                'category_id' => $categories['Computer Science']->id,
                'photo' => null,
            ],
            [
                'title' => 'Mobile Application for Disaster Risk Assessment and Management',
                'author_name' => 'Pedro Reyes',
                'email' => 'pedro.reyes@ccs.edu',
                'category_id' => $categories['Information Systems']->id,
                'photo' => null,
            ],
            [
                'title' => 'Deep Learning Framework for Medical Image Analysis and Classification',
                'author_name' => 'Lisa Wong',
                'email' => 'lisa.wong@ccs.edu',
                'category_id' => $categories['Computer Science']->id,
                'photo' => null,
            ],
            [
                'title' => 'Cybersecurity Framework for Banking Systems and Financial Institutions',
                'author_name' => 'Mark Villanueva',
                'email' => 'mark.villanueva@ccs.edu',
                'category_id' => $categories['Information Technology']->id,
                'photo' => null,
            ],
            [
                'title' => 'DevOps Pipeline Automation for Continuous Integration and Deployment',
                'author_name' => 'Sandra Lim',
                'email' => 'sandra.lim@ccs.edu',
                'category_id' => $categories['Software Engineering']->id,
                'photo' => null,
            ],
            [
                'title' => 'Natural Language Processing for Filipino Language Text Classification',
                'author_name' => 'Adrian Cruz',
                'email' => 'adrian.cruz@ccs.edu',
                'category_id' => $categories['Computer Science']->id,
                'photo' => null,
            ],
        ];

        // Create active titles
        foreach ($activeTitles as $title) {
            ResearchTitle::create($title);
        }

        // Soft-deleted (trashed) research titles (3+)
        $trashedTitles = [
            [
                'title' => 'Legacy Database Migration from SQL Server to NoSQL Architecture',
                'author_name' => 'Vincent Santos',
                'email' => 'vincent.santos@ccs.edu',
                'category_id' => $categories['Software Engineering']->id,
                'photo' => null,
            ],
            [
                'title' => 'Augmented Reality Application for Educational and Training Purposes',
                'author_name' => 'Michelle Garcia',
                'email' => 'michelle.garcia@ccs.edu',
                'category_id' => $categories['Information Technology']->id,
                'photo' => null,
            ],
            [
                'title' => 'Quantum Computing Simulator for Algorithm Testing and Optimization',
                'author_name' => 'Daniel Park',
                'email' => 'daniel.park@ccs.edu',
                'category_id' => $categories['Computer Science']->id,
                'photo' => null,
            ],
        ];

        // Create soft-deleted titles
        foreach ($trashedTitles as $title) {
            $research = ResearchTitle::create($title);
            $research->delete(); // Soft delete
        }
    }
}
