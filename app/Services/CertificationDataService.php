<?php

namespace App\Services;

class CertificationDataService
{
    /**
     * Get all available certifications
     */
    public static function all(): array
    {
        return [
            'az-900' => self::getAZ900(),
            'az-104' => self::getAZ104(),
            'az-204' => self::getAZ204(),
            // Add more certifications here
        ];
    }

    /**
     * Find a certification by slug
     */
    public static function find(string $slug): ?array
    {
        $certifications = self::all();
        return $certifications[$slug] ?? null;
    }

    /**
     * AZ-900: Azure Fundamentals
     */
    private static function getAZ900(): array
    {
        return [
            'code' => 'AZ-900',
            'slug' => 'az-900',
            'name' => 'Microsoft Azure Fundamentals',
            'level' => 'Foundational',
            'levelColor' => 'green',
            'description' => 'Demonstrate foundational knowledge of cloud concepts, core Azure services, plus Azure management and governance features and tools.',
            'longDescription' => 'The AZ-900 certification is the perfect starting point for anyone looking to understand cloud computing and Microsoft Azure. This certification validates your foundational knowledge of cloud services and how those services are provided with Microsoft Azure.',
            'duration' => '1-2 months',
            'examDuration' => '65 minutes',
            'questions' => '40-60',
            'passingScore' => '700/1000',
            'examCost' => '$99 USD',
            'language' => 'English, Japanese, Chinese, Korean, Spanish, German, French',
            'lastUpdated' => 'January 2024',
            'prerequisites' => [
                'No technical prerequisites required',
                'Basic understanding of IT concepts is helpful',
                'Familiarity with web technologies is beneficial',
            ],
            'targetAudience' => [
                'IT professionals beginning to work with Azure',
                'Anyone interested in cloud computing fundamentals',
                'Sales and purchasing professionals',
                'Students and career changers',
                'Technical managers and decision makers',
            ],
            'skills' => [
                [
                    'name' => 'Describe Cloud Concepts',
                    'weight' => '25-30%',
                    'topics' => [
                        'Define cloud computing',
                        'Describe the shared responsibility model',
                        'Define cloud models (public, private, hybrid)',
                        'Describe the consumption-based model',
                        'Compare cloud pricing models',
                    ],
                ],
                [
                    'name' => 'Describe Azure Architecture and Services',
                    'weight' => '35-40%',
                    'topics' => [
                        'Describe Azure regions, region pairs, and sovereign regions',
                        'Describe availability zones',
                        'Describe Azure datacenters',
                        'Describe Azure resources and resource groups',
                        'Describe subscriptions and management groups',
                        'Describe Azure compute and networking services',
                        'Describe Azure storage services',
                        'Describe Azure identity, access, and security',
                    ],
                ],
                [
                    'name' => 'Describe Azure Management and Governance',
                    'weight' => '30-35%',
                    'topics' => [
                        'Describe cost management in Azure',
                        'Describe features and tools for governance and compliance',
                        'Describe features and tools for managing and deploying Azure resources',
                        'Describe monitoring tools in Azure',
                    ],
                ],
            ],
            'modules' => [
                [
                    'number' => 1,
                    'title' => 'Cloud Concepts',
                    'duration' => '2-3 hours',
                    'lessons' => [
                        'Introduction to Cloud Computing',
                        'Benefits of Cloud Services',
                        'Cloud Service Types (IaaS, PaaS, SaaS)',
                        'Shared Responsibility Model',
                        'Cloud Deployment Models',
                    ],
                ],
                [
                    'number' => 2,
                    'title' => 'Azure Core Services',
                    'duration' => '4-5 hours',
                    'lessons' => [
                        'Azure Architectural Components',
                        'Azure Compute Services',
                        'Azure Networking Services',
                        'Azure Storage Services',
                        'Azure Database Services',
                    ],
                ],
                [
                    'number' => 3,
                    'title' => 'Security, Privacy, and Compliance',
                    'duration' => '3-4 hours',
                    'lessons' => [
                        'Azure Identity Services',
                        'Azure Security Tools and Features',
                        'Azure Governance Methodologies',
                        'Privacy and Compliance Resources',
                        'Azure Trust Center',
                    ],
                ],
                [
                    'number' => 4,
                    'title' => 'Azure Pricing and Support',
                    'duration' => '2-3 hours',
                    'lessons' => [
                        'Azure Subscriptions and Management',
                        'Planning and Managing Costs',
                        'Azure Service Level Agreements',
                        'Azure Service Lifecycle',
                        'Azure Support Options',
                    ],
                ],
            ],
            'resources' => [
                [
                    'type' => 'official',
                    'title' => 'Microsoft Learn Path',
                    'description' => 'Free official learning path from Microsoft',
                    'url' => 'https://learn.microsoft.com/en-us/certifications/azure-fundamentals/',
                    'icon' => 'microsoft',
                ],
                [
                    'type' => 'practice',
                    'title' => 'Practice Assessment',
                    'description' => 'Official practice questions from Microsoft',
                    'url' => '#',
                    'icon' => 'test',
                ],
                [
                    'type' => 'video',
                    'title' => 'Video Course',
                    'description' => 'Comprehensive video tutorials',
                    'url' => '#',
                    'icon' => 'video',
                ],
                [
                    'type' => 'sandbox',
                    'title' => 'Azure Sandbox',
                    'description' => 'Hands-on practice environment',
                    'url' => '#',
                    'icon' => 'code',
                ],
            ],
            'faqs' => [
                [
                    'question' => 'Is coding knowledge required for AZ-900?',
                    'answer' => 'No, AZ-900 does not require any programming or coding knowledge. It focuses on cloud concepts and Azure services at a foundational level.',
                ],
                [
                    'question' => 'How long should I study for AZ-900?',
                    'answer' => 'Most candidates spend 2-4 weeks preparing, studying 1-2 hours per day. However, this varies based on your existing IT knowledge.',
                ],
                [
                    'question' => 'Can I retake the exam if I fail?',
                    'answer' => 'Yes, you can retake the exam. There is a 24-hour waiting period for the first retake, and subsequent retakes require a 14-day wait.',
                ],
                [
                    'question' => 'Is AZ-900 worth it for my career?',
                    'answer' => 'Absolutely! AZ-900 demonstrates cloud knowledge to employers and serves as a stepping stone to more advanced Azure certifications.',
                ],
            ],
            'relatedCertifications' => [
                ['code' => 'AZ-104', 'name' => 'Azure Administrator', 'slug' => 'az-104', 'level' => 'Associate'],
                ['code' => 'AZ-204', 'name' => 'Azure Developer', 'slug' => 'az-204', 'level' => 'Associate'],
                ['code' => 'AZ-305', 'name' => 'Azure Solutions Architect', 'slug' => 'az-305', 'level' => 'Expert'],
            ],
        ];
    }

    /**
     * AZ-104: Azure Administrator
     */
    private static function getAZ104(): array
    {
        return [
            'code' => 'AZ-104',
            'slug' => 'az-104',
            'name' => 'Microsoft Azure Administrator',
            'level' => 'Associate',
            'levelColor' => 'blue',
            'description' => 'Demonstrate expertise in implementing, managing, and monitoring an organization\'s Microsoft Azure environment.',
            'longDescription' => 'The AZ-104 certification validates your expertise in implementing, managing, and monitoring identity, governance, storage, compute, and virtual networks in a cloud environment. This is one of the most sought-after Azure certifications for IT professionals.',
            'duration' => '3-4 months',
            'examDuration' => '120 minutes',
            'questions' => '40-60',
            'passingScore' => '700/1000',
            'examCost' => '$165 USD',
            'language' => 'English, Japanese, Chinese, Korean, Spanish, German, French',
            'lastUpdated' => 'December 2023',
            'prerequisites' => [
                'Understanding of on-premises virtualization technologies',
                'Understanding of networking and storage',
                'AZ-900 recommended but not required',
                '6+ months hands-on experience with Azure',
            ],
            'targetAudience' => [
                'Azure Administrators',
                'System Administrators transitioning to cloud',
                'Infrastructure Engineers',
                'IT Operations professionals',
            ],
            'skills' => [
                [
                    'name' => 'Manage Azure Identities and Governance',
                    'weight' => '20-25%',
                    'topics' => [
                        'Manage Microsoft Entra users and groups',
                        'Manage access with Azure RBAC',
                        'Manage Azure subscriptions and governance',
                    ],
                ],
                [
                    'name' => 'Implement and Manage Storage',
                    'weight' => '15-20%',
                    'topics' => [
                        'Configure storage accounts',
                        'Configure Azure Blob Storage',
                        'Configure Azure Files and Azure File Sync',
                    ],
                ],
                [
                    'name' => 'Deploy and Manage Azure Compute Resources',
                    'weight' => '20-25%',
                    'topics' => [
                        'Automate deployment by using templates',
                        'Create and configure VMs',
                        'Provision and manage containers',
                        'Create and configure Azure App Service',
                    ],
                ],
                [
                    'name' => 'Implement and Manage Virtual Networking',
                    'weight' => '15-20%',
                    'topics' => [
                        'Configure virtual networks',
                        'Configure secure access to virtual networks',
                        'Configure load balancing',
                        'Monitor virtual networking',
                    ],
                ],
                [
                    'name' => 'Monitor and Maintain Azure Resources',
                    'weight' => '10-15%',
                    'topics' => [
                        'Monitor resources by using Azure Monitor',
                        'Implement backup and recovery',
                    ],
                ],
            ],
            'modules' => [
                [
                    'number' => 1,
                    'title' => 'Identity and Governance',
                    'duration' => '6-8 hours',
                    'lessons' => [
                        'Microsoft Entra ID',
                        'Users and Groups Management',
                        'Azure RBAC',
                        'Azure Policy',
                        'Azure Blueprints',
                    ],
                ],
                [
                    'number' => 2,
                    'title' => 'Storage',
                    'duration' => '5-6 hours',
                    'lessons' => [
                        'Storage Account Configuration',
                        'Blob Storage',
                        'Azure Files',
                        'Storage Security',
                        'Storage Tools',
                    ],
                ],
                [
                    'number' => 3,
                    'title' => 'Compute',
                    'duration' => '8-10 hours',
                    'lessons' => [
                        'Virtual Machines',
                        'VM Availability',
                        'App Service',
                        'Container Instances',
                        'Azure Kubernetes Service',
                    ],
                ],
                [
                    'number' => 4,
                    'title' => 'Networking',
                    'duration' => '8-10 hours',
                    'lessons' => [
                        'Virtual Networks',
                        'Network Security Groups',
                        'Azure Firewall',
                        'Load Balancing',
                        'VPN and ExpressRoute',
                    ],
                ],
            ],
            'resources' => [
                [
                    'type' => 'official',
                    'title' => 'Microsoft Learn Path',
                    'description' => 'Free official learning path from Microsoft',
                    'url' => 'https://learn.microsoft.com/en-us/certifications/azure-administrator/',
                    'icon' => 'microsoft',
                ],
                [
                    'type' => 'practice',
                    'title' => 'Practice Assessment',
                    'description' => 'Official practice questions',
                    'url' => '#',
                    'icon' => 'test',
                ],
            ],
            'faqs' => [
                [
                    'question' => 'Should I take AZ-900 before AZ-104?',
                    'answer' => 'While not required, AZ-900 provides a good foundation. If you have Azure experience, you can go directly to AZ-104.',
                ],
                [
                    'question' => 'How much hands-on experience do I need?',
                    'answer' => 'Microsoft recommends at least 6 months of hands-on experience administering Azure environments.',
                ],
            ],
            'relatedCertifications' => [
                ['code' => 'AZ-900', 'name' => 'Azure Fundamentals', 'slug' => 'az-900', 'level' => 'Foundational'],
                ['code' => 'AZ-305', 'name' => 'Azure Solutions Architect', 'slug' => 'az-305', 'level' => 'Expert'],
                ['code' => 'AZ-500', 'name' => 'Azure Security Engineer', 'slug' => 'az-500', 'level' => 'Associate'],
            ],
        ];
    }

    /**
     * AZ-204: Azure Developer
     */
    private static function getAZ204(): array
    {
        return [
            'code' => 'AZ-204',
            'slug' => 'az-204',
            'name' => 'Developing Solutions for Microsoft Azure',
            'level' => 'Associate',
            'levelColor' => 'blue',
            'description' => 'Demonstrate expertise in designing, building, testing, and maintaining cloud applications and services on Microsoft Azure.',
            'longDescription' => 'The AZ-204 certification is designed for developers who want to demonstrate their expertise in designing, building, testing, and maintaining cloud applications and services on Azure. This certification covers a wide range of development topics including Azure compute, storage, security, and monitoring.',
            'duration' => '3-4 months',
            'examDuration' => '120 minutes',
            'questions' => '40-60',
            'passingScore' => '700/1000',
            'examCost' => '$165 USD',
            'language' => 'English, Japanese, Chinese, Korean, Spanish, German, French',
            'lastUpdated' => 'November 2023',
            'prerequisites' => [
                '1-2 years development experience',
                'Experience with Azure SDKs',
                'Proficiency in C#, Python, or JavaScript',
                'Experience with REST APIs and data storage',
            ],
            'targetAudience' => [
                'Cloud Developers',
                'Software Engineers',
                'Full-Stack Developers',
                'DevOps Engineers',
            ],
            'skills' => [
                [
                    'name' => 'Develop Azure Compute Solutions',
                    'weight' => '25-30%',
                    'topics' => [
                        'Implement containerized solutions',
                        'Implement Azure App Service Web Apps',
                        'Implement Azure Functions',
                    ],
                ],
                [
                    'name' => 'Develop for Azure Storage',
                    'weight' => '15-20%',
                    'topics' => [
                        'Develop solutions that use Azure Cosmos DB',
                        'Develop solutions that use Azure Blob Storage',
                    ],
                ],
                [
                    'name' => 'Implement Azure Security',
                    'weight' => '20-25%',
                    'topics' => [
                        'Implement user authentication and authorization',
                        'Implement secure cloud solutions',
                    ],
                ],
                [
                    'name' => 'Monitor, Troubleshoot, and Optimize',
                    'weight' => '15-20%',
                    'topics' => [
                        'Implement caching for solutions',
                        'Troubleshoot solutions by using metrics and log data',
                    ],
                ],
                [
                    'name' => 'Connect to and Consume Azure Services',
                    'weight' => '15-20%',
                    'topics' => [
                        'Implement API Management',
                        'Develop event-based solutions',
                        'Develop message-based solutions',
                    ],
                ],
            ],
            'modules' => [
                [
                    'number' => 1,
                    'title' => 'Azure Compute Solutions',
                    'duration' => '8-10 hours',
                    'lessons' => [
                        'Azure App Service',
                        'Azure Functions',
                        'Container Instances',
                        'Azure Kubernetes Service',
                    ],
                ],
                [
                    'number' => 2,
                    'title' => 'Azure Storage Solutions',
                    'duration' => '6-8 hours',
                    'lessons' => [
                        'Azure Cosmos DB Development',
                        'Blob Storage Solutions',
                        'Storage Security',
                    ],
                ],
                [
                    'number' => 3,
                    'title' => 'Azure Security',
                    'duration' => '6-8 hours',
                    'lessons' => [
                        'Authentication with Microsoft Identity',
                        'Azure Key Vault',
                        'Managed Identities',
                    ],
                ],
            ],
            'resources' => [
                [
                    'type' => 'official',
                    'title' => 'Microsoft Learn Path',
                    'description' => 'Free official learning path',
                    'url' => 'https://learn.microsoft.com/en-us/certifications/azure-developer/',
                    'icon' => 'microsoft',
                ],
            ],
            'faqs' => [
                [
                    'question' => 'What programming languages are tested?',
                    'answer' => 'The exam focuses on concepts rather than specific languages, but examples are often in C# or Python.',
                ],
            ],
            'relatedCertifications' => [
                ['code' => 'AZ-400', 'name' => 'Azure DevOps Engineer', 'slug' => 'az-400', 'level' => 'Expert'],
                ['code' => 'AZ-104', 'name' => 'Azure Administrator', 'slug' => 'az-104', 'level' => 'Associate'],
            ],
        ];
    }
}
