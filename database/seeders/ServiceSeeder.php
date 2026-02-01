<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get category mappings
        $categories = [
            'compute' => ServiceCategory::where('slug', 'compute')->first(),
            'storage' => ServiceCategory::where('slug', 'storage')->first(),
            'networking' => ServiceCategory::where('slug', 'networking')->first(),
            'databases' => ServiceCategory::where('slug', 'databases')->first(),
            'ai-ml' => ServiceCategory::where('slug', 'ai-ml')->first(),
            'security' => ServiceCategory::where('slug', 'security')->first(),
            'devops' => ServiceCategory::where('slug', 'devops')->first(),
            'analytics' => ServiceCategory::where('slug', 'analytics')->first(),
            'integration' => ServiceCategory::where('slug', 'integration')->first(),
            'monitoring' => ServiceCategory::where('slug', 'monitoring')->first(),
        ];

        // All services from the frontend
        $services = [
            // COMPUTE
            ['category' => 'compute', 'name' => 'Virtual Machines', 'icon_identifier' => 'vm', 'difficulty' => 'intermediate', 'order' => 1, 'description' => 'Deploy and manage virtual machines in the cloud with full control over OS and configuration.'],
            ['category' => 'compute', 'name' => 'App Service', 'icon_identifier' => 'app-service', 'difficulty' => 'beginner', 'order' => 2, 'description' => 'Build and host web apps, mobile backends, and RESTful APIs without managing infrastructure.'],
            ['category' => 'compute', 'name' => 'Functions', 'icon_identifier' => 'functions', 'difficulty' => 'intermediate', 'order' => 3, 'description' => 'Event-driven serverless compute platform to run code on-demand without managing infrastructure.'],
            ['category' => 'compute', 'name' => 'Container Instances', 'icon_identifier' => 'container', 'difficulty' => 'intermediate', 'order' => 4, 'description' => 'Run containers without managing servers, offering fast startup times and per-second billing.'],
            ['category' => 'compute', 'name' => 'Kubernetes Service', 'icon_identifier' => 'aks', 'difficulty' => 'advanced', 'order' => 5, 'description' => 'Fully managed Kubernetes service for deploying and managing containerized applications at scale.'],
            ['category' => 'compute', 'name' => 'Batch', 'icon_identifier' => 'batch', 'difficulty' => 'advanced', 'order' => 6, 'description' => 'Run large-scale parallel and high-performance computing applications efficiently in the cloud.'],
            ['category' => 'compute', 'name' => 'Cloud Services', 'icon_identifier' => 'default', 'difficulty' => 'intermediate', 'order' => 7, 'description' => 'Platform for deploying highly available and scalable cloud applications.'],
            ['category' => 'compute', 'name' => 'VM Scale Sets', 'icon_identifier' => 'vm', 'difficulty' => 'advanced', 'order' => 8, 'description' => 'Deploy and manage a set of identical, auto-scaling virtual machines for high availability.'],

            // STORAGE
            ['category' => 'storage', 'name' => 'Storage Accounts', 'icon_identifier' => 'storage-account', 'difficulty' => 'beginner', 'order' => 1, 'description' => 'Durable, highly available, and massively scalable cloud storage solution.'],
            ['category' => 'storage', 'name' => 'Blob Storage', 'icon_identifier' => 'blob', 'difficulty' => 'beginner', 'order' => 2, 'description' => 'Object storage solution for unstructured data like images, videos, and documents.'],
            ['category' => 'storage', 'name' => 'File Storage', 'icon_identifier' => 'file-storage', 'difficulty' => 'beginner', 'order' => 3, 'description' => 'Fully managed file shares in the cloud accessible via SMB protocol.'],
            ['category' => 'storage', 'name' => 'Queue Storage', 'icon_identifier' => 'queue', 'difficulty' => 'intermediate', 'order' => 4, 'description' => 'Simple message queuing for large workloads and reliable asynchronous messaging.'],
            ['category' => 'storage', 'name' => 'Table Storage', 'icon_identifier' => 'default', 'difficulty' => 'intermediate', 'order' => 5, 'description' => 'NoSQL key-value store for structured data with schema-less design.'],
            ['category' => 'storage', 'name' => 'Data Lake', 'icon_identifier' => 'default', 'difficulty' => 'advanced', 'order' => 6, 'description' => 'Scalable and secure data lake for high-performance analytics workloads.'],
            ['category' => 'storage', 'name' => 'Managed Disks', 'icon_identifier' => 'disk', 'difficulty' => 'intermediate', 'order' => 7, 'description' => 'Block-level storage volumes managed by Azure for use with virtual machines.'],

            // NETWORKING
            ['category' => 'networking', 'name' => 'Virtual Network', 'icon' => 'vnet', 'difficulty' => 'intermediate', 'order' => 1, 'description' => 'Isolated network for Azure resources with secure communication and connectivity options.'],
            ['category' => 'networking', 'name' => 'Load Balancer', 'icon' => 'load-balancer', 'difficulty' => 'intermediate', 'order' => 2, 'description' => 'Distribute network traffic across multiple servers for high availability and reliability.'],
            ['category' => 'networking', 'name' => 'Application Gateway', 'icon' => 'app-gateway', 'difficulty' => 'advanced', 'order' => 3, 'description' => 'Web traffic load balancer with application-level routing and SSL termination.'],
            ['category' => 'networking', 'name' => 'VPN Gateway', 'icon' => 'vpn', 'difficulty' => 'intermediate', 'order' => 4, 'description' => 'Secure cross-premises connectivity between Azure and on-premises networks.'],
            ['category' => 'networking', 'name' => 'Azure DNS', 'icon' => 'dns', 'difficulty' => 'beginner', 'order' => 5, 'description' => 'Host DNS domains with high availability and fast DNS responses using Azure infrastructure.'],
            ['category' => 'networking', 'name' => 'CDN', 'icon' => 'cdn', 'difficulty' => 'beginner', 'order' => 6, 'description' => 'Deliver content to users with low latency using a global network of edge servers.'],
            ['category' => 'networking', 'name' => 'Front Door', 'icon' => 'front-door', 'difficulty' => 'advanced', 'order' => 7, 'description' => 'Scalable and secure entry point for fast delivery of global web applications.'],
            ['category' => 'networking', 'name' => 'ExpressRoute', 'icon' => 'expressroute', 'difficulty' => 'advanced', 'order' => 8, 'description' => 'Private dedicated connection between on-premises infrastructure and Azure datacenters.'],

            // DATABASES
            ['category' => 'databases', 'name' => 'SQL Database', 'icon' => 'sql', 'difficulty' => 'intermediate', 'order' => 1, 'description' => 'Fully managed relational database with built-in intelligence and high availability.'],
            ['category' => 'databases', 'name' => 'Cosmos DB', 'icon' => 'cosmos', 'difficulty' => 'advanced', 'order' => 2, 'description' => 'Globally distributed, multi-model NoSQL database for mission-critical applications.'],
            ['category' => 'databases', 'name' => 'MySQL', 'icon' => 'mysql', 'difficulty' => 'beginner', 'order' => 3, 'description' => 'Fully managed MySQL database with high availability and automatic backups.'],
            ['category' => 'databases', 'name' => 'PostgreSQL', 'icon' => 'postgresql', 'difficulty' => 'beginner', 'order' => 4, 'description' => 'Fully managed PostgreSQL database with advanced security and monitoring.'],
            ['category' => 'databases', 'name' => 'SQL Managed Instance', 'icon' => 'sql-mi', 'difficulty' => 'advanced', 'order' => 5, 'description' => 'Fully managed SQL Server instance with near 100% compatibility with SQL Server.'],
            ['category' => 'databases', 'name' => 'Redis Cache', 'icon' => 'redis', 'difficulty' => 'intermediate', 'order' => 6, 'description' => 'In-memory data store for high-performance caching and real-time analytics.'],
            ['category' => 'databases', 'name' => 'MariaDB', 'icon' => 'mariadb', 'difficulty' => 'beginner', 'order' => 7, 'description' => 'Fully managed MariaDB database with high availability and security features.'],

            // AI + ML
            ['category' => 'ai-ml', 'name' => 'Machine Learning', 'icon' => 'ml', 'difficulty' => 'advanced', 'order' => 1, 'description' => 'Enterprise-grade machine learning service to build and deploy models faster.'],
            ['category' => 'ai-ml', 'name' => 'Cognitive Services', 'icon' => 'cognitive', 'difficulty' => 'intermediate', 'order' => 2, 'description' => 'Add AI capabilities like vision, speech, and language understanding to applications.'],
            ['category' => 'ai-ml', 'name' => 'Azure OpenAI', 'icon' => 'openai', 'difficulty' => 'intermediate', 'order' => 3, 'description' => 'Advanced language models including GPT-4 and ChatGPT for AI-powered applications.'],
            ['category' => 'ai-ml', 'name' => 'Bot Service', 'icon' => 'bot', 'difficulty' => 'intermediate', 'order' => 4, 'description' => 'Develop intelligent, enterprise-grade conversational bots quickly and easily.'],
            ['category' => 'ai-ml', 'name' => 'Computer Vision', 'icon' => 'vision', 'difficulty' => 'intermediate', 'order' => 5, 'description' => 'Extract information from images and videos using AI-powered analysis.'],
            ['category' => 'ai-ml', 'name' => 'Speech Services', 'icon' => 'speech', 'difficulty' => 'intermediate', 'order' => 6, 'description' => 'Speech to text, text to speech, and speech translation capabilities.'],
            ['category' => 'ai-ml', 'name' => 'Language Service', 'icon' => 'language', 'difficulty' => 'intermediate', 'order' => 7, 'description' => 'Natural language processing for sentiment analysis, key phrase extraction, and more.'],
            ['category' => 'ai-ml', 'name' => 'Document Intelligence', 'icon' => 'document', 'difficulty' => 'advanced', 'order' => 8, 'description' => 'Extract text, key-value pairs, and tables from documents using AI.'],

            // SECURITY
            ['category' => 'security', 'name' => 'Microsoft Entra ID', 'icon' => 'entra', 'difficulty' => 'intermediate', 'order' => 1, 'description' => 'Cloud-based identity and access management service for secure authentication.'],
            ['category' => 'security', 'name' => 'Key Vault', 'icon' => 'keyvault', 'difficulty' => 'intermediate', 'order' => 2, 'description' => 'Securely store and access secrets, keys, and certificates used by applications.'],
            ['category' => 'security', 'name' => 'Security Center', 'icon' => 'security-center', 'difficulty' => 'advanced', 'order' => 3, 'description' => 'Unified security management and advanced threat protection across hybrid workloads.'],
            ['category' => 'security', 'name' => 'Sentinel', 'icon' => 'sentinel', 'difficulty' => 'advanced', 'order' => 4, 'description' => 'Cloud-native SIEM and SOAR solution for intelligent security analytics.'],
            ['category' => 'security', 'name' => 'DDoS Protection', 'icon' => 'ddos', 'difficulty' => 'intermediate', 'order' => 5, 'description' => 'Protect applications from distributed denial-of-service attacks.'],
            ['category' => 'security', 'name' => 'Firewall', 'icon' => 'firewall', 'difficulty' => 'advanced', 'order' => 6, 'description' => 'Cloud-native network firewall security service to protect Azure resources.'],

            // DEVOPS
            ['category' => 'devops', 'name' => 'Azure DevOps', 'icon' => 'azure-devops', 'difficulty' => 'intermediate', 'order' => 1, 'description' => 'Complete DevOps toolchain for planning, developing, and delivering software.'],
            ['category' => 'devops', 'name' => 'GitHub Actions', 'icon' => 'github', 'difficulty' => 'intermediate', 'order' => 2, 'description' => 'Automate workflows from code to cloud with CI/CD integration.'],
            ['category' => 'devops', 'name' => 'Container Registry', 'icon' => 'acr', 'difficulty' => 'intermediate', 'order' => 3, 'description' => 'Manage container images and artifacts with geo-replication and security scanning.'],
            ['category' => 'devops', 'name' => 'Pipelines', 'icon' => 'pipelines', 'difficulty' => 'intermediate', 'order' => 4, 'description' => 'Continuously build, test, and deploy to any platform and cloud.'],
            ['category' => 'devops', 'name' => 'Repos', 'icon' => 'repos', 'difficulty' => 'beginner', 'order' => 5, 'description' => 'Git repositories with unlimited free private repos and advanced collaboration.'],
            ['category' => 'devops', 'name' => 'Artifacts', 'icon' => 'artifacts', 'difficulty' => 'intermediate', 'order' => 6, 'description' => 'Create, host, and share packages with your team and add artifacts to CI/CD pipelines.'],

            // ANALYTICS
            ['category' => 'analytics', 'name' => 'Synapse Analytics', 'icon' => 'synapse', 'difficulty' => 'advanced', 'order' => 1, 'description' => 'Limitless analytics service with unmatched time to insight across data warehouses.'],
            ['category' => 'analytics', 'name' => 'Data Factory', 'icon' => 'data-factory', 'difficulty' => 'advanced', 'order' => 2, 'description' => 'Hybrid data integration service to create, schedule, and orchestrate ETL/ELT workflows.'],
            ['category' => 'analytics', 'name' => 'Databricks', 'icon' => 'databricks', 'difficulty' => 'advanced', 'order' => 3, 'description' => 'Apache Spark-based analytics platform for big data and machine learning.'],
            ['category' => 'analytics', 'name' => 'Stream Analytics', 'icon' => 'stream', 'difficulty' => 'advanced', 'order' => 4, 'description' => 'Real-time analytics on fast-moving streams of data from applications and devices.'],
            ['category' => 'analytics', 'name' => 'HDInsight', 'icon' => 'hdinsight', 'difficulty' => 'advanced', 'order' => 5, 'description' => 'Fully managed cloud Apache Hadoop and Spark service for big data processing.'],
            ['category' => 'analytics', 'name' => 'Power BI Embedded', 'icon' => 'powerbi', 'difficulty' => 'intermediate', 'order' => 6, 'description' => 'Embed fully interactive, stunning data visualizations in applications.'],

            // INTEGRATION
            ['category' => 'integration', 'name' => 'Logic Apps', 'icon' => 'logic-apps', 'difficulty' => 'intermediate', 'order' => 1, 'description' => 'Automate workflows and integrate apps, data, and services across organizations.'],
            ['category' => 'integration', 'name' => 'Service Bus', 'icon' => 'service-bus', 'difficulty' => 'intermediate', 'order' => 2, 'description' => 'Reliable cloud messaging as a service and simple hybrid integration.'],
            ['category' => 'integration', 'name' => 'Event Grid', 'icon' => 'event-grid', 'difficulty' => 'intermediate', 'order' => 3, 'description' => 'Event routing service for reactive programming using publish-subscribe model.'],
            ['category' => 'integration', 'name' => 'Event Hubs', 'icon' => 'event-hubs', 'difficulty' => 'advanced', 'order' => 4, 'description' => 'Big data streaming platform and event ingestion service for real-time data.'],
            ['category' => 'integration', 'name' => 'API Management', 'icon' => 'apim', 'difficulty' => 'advanced', 'order' => 5, 'description' => 'Publish, manage, secure, and analyze APIs in minutes across clouds.'],

            // MONITORING
            ['category' => 'monitoring', 'name' => 'Azure Monitor', 'icon' => 'monitor-icon', 'difficulty' => 'intermediate', 'order' => 1, 'description' => 'Full observability into applications, infrastructure, and network with monitoring and diagnostics.'],
            ['category' => 'monitoring', 'name' => 'Log Analytics', 'icon' => 'log-analytics', 'difficulty' => 'intermediate', 'order' => 2, 'description' => 'Collect and analyze log data from cloud and on-premises environments.'],
            ['category' => 'monitoring', 'name' => 'Application Insights', 'icon' => 'app-insights', 'difficulty' => 'intermediate', 'order' => 3, 'description' => 'Application performance management service for web developers on multiple platforms.'],
            ['category' => 'monitoring', 'name' => 'Alerts', 'icon' => 'alerts', 'difficulty' => 'beginner', 'order' => 4, 'description' => 'Get notified when important conditions are met in monitoring data.'],
        ];

        // Create services
        foreach ($services as $serviceData) {
            $category = $categories[$serviceData['category']];
            
            if ($category) {
                $existing = Service::where('service_category_id', $category->id)
                    ->where('name', $serviceData['name'])
                    ->first();

                if ($existing) {
                    $existing->update([
                        'description' => $serviceData['description'],
                        'icon_identifier' => $serviceData['icon_identifier'] ?? 'default',
                        'difficulty' => $serviceData['difficulty'],
                        'order' => $serviceData['order'],
                        'is_active' => true,
                    ]);
                } else {
                    Service::create([
                        'service_category_id' => $category->id,
                        'name' => $serviceData['name'],
                        'description' => $serviceData['description'],
                        'icon_identifier' => $serviceData['icon_identifier'] ?? 'default',
                        'difficulty' => $serviceData['difficulty'],
                        'order' => $serviceData['order'],
                        'is_active' => true,
                    ]);
                }
            }
        }
    }
}
