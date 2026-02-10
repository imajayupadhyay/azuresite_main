<?php

namespace Database\Seeders;

use App\Models\Certification;
use App\Models\CertificationCategory;
use Illuminate\Database\Seeder;

class CertificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foundationCategory = CertificationCategory::where('slug', 'foundation')->first();
        $associateCategory = CertificationCategory::where('slug', 'associate')->first();
        $expertCategory = CertificationCategory::where('slug', 'expert')->first();

        $certifications = [
            // Foundation - AZ-900
            [
                'certification_category_id' => $foundationCategory?->id,
                'code' => 'AZ-900',
                'name' => 'Azure Fundamentals',
                'slug' => 'az-900-azure-fundamentals',
                'description' => 'Demonstrate foundational knowledge of cloud services and how those services are provided with Microsoft Azure.',
                'long_description' => 'The Azure Fundamentals certification is designed for candidates who want to demonstrate foundational-level knowledge of cloud services and how those services are provided with Microsoft Azure. This certification is intended for candidates with non-technical backgrounds, such as those involved in selling or purchasing cloud-based solutions and services, or who have some involvement with cloud-based solutions and services, as well as those with a technical background who need to validate their foundational-level knowledge around cloud services.',
                'level_color' => 'green',
                'exam_duration' => '60 minutes',
                'questions' => '40-60',
                'passing_score' => '700/1000',
                'exam_cost' => '$165 USD',
                'duration' => '1-2 months',
                'last_updated' => 'January 2024',
                'prerequisites' => [
                    'No technical IT experience required',
                    'General understanding of cloud computing concepts is helpful',
                    'Basic understanding of IT services (networking, storage, compute)',
                ],
                'target_audience' => [
                    'IT professionals beginning to work with Azure',
                    'Anyone interested in learning about cloud computing',
                    'Technical and non-technical professionals exploring Azure',
                    'Students and career changers entering the cloud industry',
                ],
                'modules' => [
                    [
                        'number' => 1,
                        'title' => 'Describe Cloud Concepts',
                        'duration' => '2 hours',
                        'lessons' => [
                            'Introduction to cloud computing',
                            'Benefits of using cloud services',
                            'Cloud service types (IaaS, PaaS, SaaS)',
                            'Cloud deployment models',
                        ],
                    ],
                    [
                        'number' => 2,
                        'title' => 'Describe Azure Architecture and Services',
                        'duration' => '4 hours',
                        'lessons' => [
                            'Azure regions and availability zones',
                            'Azure resources and resource groups',
                            'Azure compute and networking services',
                            'Azure storage services',
                        ],
                    ],
                    [
                        'number' => 3,
                        'title' => 'Describe Azure Management and Governance',
                        'duration' => '3 hours',
                        'lessons' => [
                            'Cost management in Azure',
                            'Azure governance and compliance',
                            'Azure resource management tools',
                            'Monitoring and management tools',
                        ],
                    ],
                ],
                'skills' => [
                    [
                        'name' => 'Describe cloud concepts',
                        'weight' => '25-30%',
                        'topics' => [
                            'Define cloud computing',
                            'Describe the benefits of using cloud services',
                            'Describe cloud service types',
                        ],
                    ],
                    [
                        'name' => 'Describe Azure architecture and services',
                        'weight' => '35-40%',
                        'topics' => [
                            'Describe the core architectural components of Azure',
                            'Describe Azure compute and networking services',
                            'Describe Azure storage services',
                        ],
                    ],
                    [
                        'name' => 'Describe Azure management and governance',
                        'weight' => '30-35%',
                        'topics' => [
                            'Describe cost management in Azure',
                            'Describe features and tools for governance and compliance',
                            'Describe features and tools for managing and deploying Azure resources',
                        ],
                    ],
                ],
                'resources' => [
                    [
                        'icon' => 'microsoft',
                        'title' => 'Microsoft Learn Path',
                        'description' => 'Official free learning path from Microsoft',
                        'url' => 'https://learn.microsoft.com/en-us/training/paths/az-900-describe-cloud-concepts/',
                    ],
                    [
                        'icon' => 'test',
                        'title' => 'Practice Assessment',
                        'description' => 'Free practice test from Microsoft',
                        'url' => 'https://learn.microsoft.com/en-us/certifications/exams/az-900/practice/assessment',
                    ],
                    [
                        'icon' => 'video',
                        'title' => 'Azure Fundamentals Videos',
                        'description' => 'Video tutorials covering all exam topics',
                        'url' => 'https://www.youtube.com/playlist?list=PLlVtbbG169nED0_vMEniWBQjSoxTsBYS3',
                    ],
                ],
                'faqs' => [
                    [
                        'question' => 'Is the AZ-900 exam difficult?',
                        'answer' => 'The AZ-900 is considered an entry-level exam and is designed for beginners. With proper preparation using Microsoft Learn resources, most candidates find it manageable. The exam tests fundamental concepts rather than deep technical skills.',
                    ],
                    [
                        'question' => 'How long should I study for AZ-900?',
                        'answer' => 'Most candidates spend 1-2 months preparing, depending on their existing knowledge. If you have some IT background, you might need less time. Complete beginners should plan for at least 4-6 weeks of consistent study.',
                    ],
                    [
                        'question' => 'Is AZ-900 worth it for my career?',
                        'answer' => 'Yes, AZ-900 is an excellent starting point for anyone entering the cloud industry. It validates your foundational knowledge and is often a prerequisite for more advanced Azure certifications. Many employers value this certification for entry-level cloud positions.',
                    ],
                ],
                'meta_title' => 'AZ-900 Azure Fundamentals Certification | AzureSkill',
                'meta_description' => 'Prepare for the AZ-900 Azure Fundamentals exam. Learn cloud concepts, Azure services, and management tools. Free resources and study guides.',
                'order' => 1,
                'is_active' => true,
            ],

            // Associate - AZ-104
            [
                'certification_category_id' => $associateCategory?->id,
                'code' => 'AZ-104',
                'name' => 'Azure Administrator',
                'slug' => 'az-104-azure-administrator',
                'description' => 'Implement, manage, and monitor an organization\'s Microsoft Azure environment.',
                'long_description' => 'The Azure Administrator certification demonstrates your ability to implement, manage, and monitor identity, governance, storage, compute, and virtual networks in a cloud environment. As an Azure administrator, you will be part of a larger team dedicated to implementing an organization\'s cloud infrastructure. You will coordinate with other roles to deliver Azure networking, security, database management, application development, and DevOps solutions.',
                'level_color' => 'blue',
                'exam_duration' => '120 minutes',
                'questions' => '40-60',
                'passing_score' => '700/1000',
                'exam_cost' => '$165 USD',
                'duration' => '3-4 months',
                'last_updated' => 'January 2024',
                'prerequisites' => [
                    'Understanding of on-premises virtualization technologies',
                    'Basic understanding of networking concepts',
                    'Understanding of Azure AD (Entra ID) basics',
                    'Familiarity with PowerShell and Azure CLI',
                ],
                'target_audience' => [
                    'Azure Administrators',
                    'System Administrators transitioning to cloud',
                    'IT Professionals managing Azure environments',
                    'Cloud Engineers responsible for Azure infrastructure',
                ],
                'modules' => [
                    [
                        'number' => 1,
                        'title' => 'Manage Azure Identities and Governance',
                        'duration' => '6 hours',
                        'lessons' => [
                            'Manage Azure AD objects',
                            'Manage role-based access control (RBAC)',
                            'Manage subscriptions and governance',
                            'Configure Azure policies',
                        ],
                    ],
                    [
                        'number' => 2,
                        'title' => 'Implement and Manage Storage',
                        'duration' => '5 hours',
                        'lessons' => [
                            'Configure Azure storage accounts',
                            'Manage data in Azure storage',
                            'Configure Azure Files and Blob storage',
                            'Configure storage security',
                        ],
                    ],
                    [
                        'number' => 3,
                        'title' => 'Deploy and Manage Azure Compute Resources',
                        'duration' => '8 hours',
                        'lessons' => [
                            'Automate deployment using ARM templates',
                            'Create and configure VMs',
                            'Configure Azure App Service',
                            'Manage Azure Kubernetes Service',
                        ],
                    ],
                    [
                        'number' => 4,
                        'title' => 'Configure and Manage Virtual Networking',
                        'duration' => '6 hours',
                        'lessons' => [
                            'Implement and manage virtual networking',
                            'Configure secure access to virtual networks',
                            'Configure load balancing',
                            'Monitor and troubleshoot virtual networking',
                        ],
                    ],
                    [
                        'number' => 5,
                        'title' => 'Monitor and Backup Azure Resources',
                        'duration' => '4 hours',
                        'lessons' => [
                            'Monitor resources using Azure Monitor',
                            'Implement backup and recovery',
                            'Configure alerts and action groups',
                            'Analyze metrics and logs',
                        ],
                    ],
                ],
                'skills' => [
                    [
                        'name' => 'Manage Azure identities and governance',
                        'weight' => '20-25%',
                        'topics' => [
                            'Manage Azure AD objects',
                            'Manage access control',
                            'Manage Azure subscriptions and governance',
                        ],
                    ],
                    [
                        'name' => 'Implement and manage storage',
                        'weight' => '15-20%',
                        'topics' => [
                            'Configure access to storage',
                            'Manage data in Azure storage accounts',
                            'Configure Azure Files and Azure Blob Storage',
                        ],
                    ],
                    [
                        'name' => 'Deploy and manage Azure compute resources',
                        'weight' => '20-25%',
                        'topics' => [
                            'Automate deployment by using templates',
                            'Create and configure VMs',
                            'Create and configure containers',
                            'Create and configure Azure App Service',
                        ],
                    ],
                    [
                        'name' => 'Configure and manage virtual networking',
                        'weight' => '20-25%',
                        'topics' => [
                            'Configure virtual networks',
                            'Configure secure access to virtual networks',
                            'Configure load balancing',
                            'Monitor virtual networking',
                        ],
                    ],
                    [
                        'name' => 'Monitor and maintain Azure resources',
                        'weight' => '10-15%',
                        'topics' => [
                            'Monitor resources by using Azure Monitor',
                            'Implement backup and recovery',
                        ],
                    ],
                ],
                'resources' => [
                    [
                        'icon' => 'microsoft',
                        'title' => 'Microsoft Learn Path',
                        'description' => 'Official AZ-104 learning path from Microsoft',
                        'url' => 'https://learn.microsoft.com/en-us/training/paths/az-104-administrator-prerequisites/',
                    ],
                    [
                        'icon' => 'test',
                        'title' => 'Practice Assessment',
                        'description' => 'Official practice test from Microsoft',
                        'url' => 'https://learn.microsoft.com/en-us/certifications/exams/az-104/practice/assessment',
                    ],
                    [
                        'icon' => 'code',
                        'title' => 'Azure Labs',
                        'description' => 'Hands-on labs for practical experience',
                        'url' => 'https://github.com/MicrosoftLearning/AZ-104-MicrosoftAzureAdministrator',
                    ],
                ],
                'faqs' => [
                    [
                        'question' => 'Should I get AZ-900 before AZ-104?',
                        'answer' => 'While AZ-900 is not a prerequisite, it is recommended if you are new to Azure. AZ-900 provides foundational knowledge that makes learning AZ-104 concepts easier. If you already have hands-on Azure experience, you can skip directly to AZ-104.',
                    ],
                    [
                        'question' => 'How difficult is the AZ-104 exam?',
                        'answer' => 'AZ-104 is considered moderately difficult and requires hands-on experience with Azure. The exam includes scenario-based questions and may include lab components. Most candidates need 3-4 months of preparation with practical experience.',
                    ],
                    [
                        'question' => 'What job roles require AZ-104?',
                        'answer' => 'AZ-104 is valuable for Azure Administrators, Cloud Engineers, System Administrators, and DevOps Engineers. It is often required or preferred for cloud administration positions and demonstrates your ability to manage Azure environments.',
                    ],
                ],
                'meta_title' => 'AZ-104 Azure Administrator Certification | AzureSkill',
                'meta_description' => 'Prepare for the AZ-104 Azure Administrator exam. Learn to manage Azure identities, storage, compute, and networking. Comprehensive study guide.',
                'order' => 1,
                'is_active' => true,
            ],

            // Expert - AZ-305
            [
                'certification_category_id' => $expertCategory?->id,
                'code' => 'AZ-305',
                'name' => 'Designing Microsoft Azure Infrastructure Solutions',
                'slug' => 'az-305-designing-azure-infrastructure-solutions',
                'description' => 'Design cloud and hybrid solutions that run on Microsoft Azure.',
                'long_description' => 'The Azure Solutions Architect Expert certification demonstrates your ability to design and implement solutions that run on Azure, including aspects like compute, network, storage, monitoring, and security. As an Azure solutions architect, you serve as an advisor to stakeholders and translate business requirements into secure, scalable, and reliable cloud solutions. You should have advanced experience and knowledge of IT operations, including networking, virtualization, identity, security, business continuity, disaster recovery, data platforms, and governance.',
                'level_color' => 'purple',
                'exam_duration' => '120 minutes',
                'questions' => '40-60',
                'passing_score' => '700/1000',
                'exam_cost' => '$165 USD',
                'duration' => '4-6 months',
                'last_updated' => 'January 2024',
                'prerequisites' => [
                    'AZ-104 Azure Administrator certification recommended',
                    'Expert-level knowledge of Azure administration',
                    'Experience with Azure development and DevOps processes',
                    'Understanding of networking, virtualization, identity, and security',
                ],
                'target_audience' => [
                    'Azure Solutions Architects',
                    'Senior Cloud Engineers',
                    'Technical Architects transitioning to cloud',
                    'IT Professionals designing enterprise Azure solutions',
                ],
                'modules' => [
                    [
                        'number' => 1,
                        'title' => 'Design Identity, Governance, and Monitoring Solutions',
                        'duration' => '8 hours',
                        'lessons' => [
                            'Design solutions for logging and monitoring',
                            'Design authentication and authorization solutions',
                            'Design governance solutions',
                            'Design identities and access for applications',
                        ],
                    ],
                    [
                        'number' => 2,
                        'title' => 'Design Data Storage Solutions',
                        'duration' => '6 hours',
                        'lessons' => [
                            'Design a data storage solution for relational data',
                            'Design a data storage solution for non-relational data',
                            'Design data integration',
                            'Recommend a data storage solution',
                        ],
                    ],
                    [
                        'number' => 3,
                        'title' => 'Design Business Continuity Solutions',
                        'duration' => '5 hours',
                        'lessons' => [
                            'Design a solution for backup and disaster recovery',
                            'Design for high availability',
                            'Identify data and application requirements',
                            'Recommend a solution for recovery',
                        ],
                    ],
                    [
                        'number' => 4,
                        'title' => 'Design Infrastructure Solutions',
                        'duration' => '10 hours',
                        'lessons' => [
                            'Design a compute solution',
                            'Design an application architecture',
                            'Design network solutions',
                            'Design migrations',
                        ],
                    ],
                ],
                'skills' => [
                    [
                        'name' => 'Design identity, governance, and monitoring solutions',
                        'weight' => '25-30%',
                        'topics' => [
                            'Design a solution for logging and monitoring',
                            'Design authentication and authorization solutions',
                            'Design governance',
                            'Design identities and access for applications',
                        ],
                    ],
                    [
                        'name' => 'Design data storage solutions',
                        'weight' => '20-25%',
                        'topics' => [
                            'Design a data storage solution for relational data',
                            'Design data storage for non-relational data',
                            'Design data integration',
                        ],
                    ],
                    [
                        'name' => 'Design business continuity solutions',
                        'weight' => '15-20%',
                        'topics' => [
                            'Design a solution for backup and disaster recovery',
                            'Design for high availability',
                        ],
                    ],
                    [
                        'name' => 'Design infrastructure solutions',
                        'weight' => '30-35%',
                        'topics' => [
                            'Design a compute solution',
                            'Design an application architecture',
                            'Design network solutions',
                            'Design migrations',
                        ],
                    ],
                ],
                'resources' => [
                    [
                        'icon' => 'microsoft',
                        'title' => 'Microsoft Learn Path',
                        'description' => 'Official AZ-305 learning path from Microsoft',
                        'url' => 'https://learn.microsoft.com/en-us/training/paths/microsoft-azure-architect-design-prerequisites/',
                    ],
                    [
                        'icon' => 'test',
                        'title' => 'Practice Assessment',
                        'description' => 'Official practice test from Microsoft',
                        'url' => 'https://learn.microsoft.com/en-us/certifications/exams/az-305/practice/assessment',
                    ],
                    [
                        'icon' => 'code',
                        'title' => 'Azure Architecture Center',
                        'description' => 'Reference architectures and best practices',
                        'url' => 'https://learn.microsoft.com/en-us/azure/architecture/',
                    ],
                    [
                        'icon' => 'video',
                        'title' => 'AZ-305 Study Guide Videos',
                        'description' => 'Comprehensive video series covering all exam topics',
                        'url' => 'https://www.youtube.com/results?search_query=az-305+study+guide',
                    ],
                ],
                'faqs' => [
                    [
                        'question' => 'Do I need AZ-104 before taking AZ-305?',
                        'answer' => 'While not strictly required, having AZ-104 or equivalent hands-on experience is highly recommended. AZ-305 builds on administrator-level knowledge and focuses on designing solutions rather than implementing them. Most successful candidates have significant Azure administration experience.',
                    ],
                    [
                        'question' => 'Is AZ-305 the hardest Azure exam?',
                        'answer' => 'AZ-305 is considered one of the more challenging Azure exams because it requires you to think like an architect. The exam tests your ability to design complete solutions, considering factors like cost, security, scalability, and reliability. Hands-on experience and understanding of architectural patterns is essential.',
                    ],
                    [
                        'question' => 'What is the Azure Solutions Architect Expert certification path?',
                        'answer' => 'To earn the Azure Solutions Architect Expert certification, you need to pass the AZ-305 exam. While there are no formal prerequisites, Microsoft recommends having experience with Azure administration, development, and DevOps processes. Many candidates complete AZ-104 first to build foundational skills.',
                    ],
                ],
                'meta_title' => 'AZ-305 Azure Solutions Architect Expert Certification | AzureSkill',
                'meta_description' => 'Prepare for the AZ-305 exam and become an Azure Solutions Architect Expert. Learn to design identity, data, business continuity, and infrastructure solutions.',
                'order' => 1,
                'is_active' => true,
            ],
        ];

        foreach ($certifications as $certData) {
            if ($certData['certification_category_id']) {
                Certification::updateOrCreate(
                    ['code' => $certData['code']],
                    $certData
                );
            }
        }
    }
}
