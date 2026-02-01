<?php

namespace App\Services;

class TutorialDataService
{
    /**
     * Get all available tutorials
     */
    public static function all(): array
    {
        return [
            'virtual-machines' => self::getVirtualMachines(),
            'app-service' => self::getAppService(),
            'functions' => self::getFunctions(),
            // Add more services here as needed
        ];
    }

    /**
     * Find a tutorial by slug
     */
    public static function find(string $slug): ?array
    {
        $tutorials = self::all();
        return $tutorials[$slug] ?? null;
    }

    /**
     * Virtual Machines Tutorial Data
     */
    private static function getVirtualMachines(): array
    {
        return [
            'name' => 'Virtual Machines',
            'slug' => 'virtual-machines',
            'category' => 'Compute',
            'description' => 'Learn how to create, configure, and manage Azure Virtual Machines. Master IaaS compute resources for scalable cloud infrastructure.',
            'difficulty' => 'Beginner to Advanced',
            'tutorials' => 12,
            'videoDuration' => '18:45',
            'iconUrl' => null,
            'videoThumbnail' => null,
            'videoUrl' => null,
            'sections' => [
                [
                    'id' => 'introduction',
                    'title' => 'Introduction to Azure Virtual Machines',
                    'content' => '<p>Azure Virtual Machines (VMs) are one of several types of on-demand, scalable computing resources that Azure offers. Typically, you choose a VM when you need more control over the computing environment than the other choices offer.</p>
                    <p>An Azure VM gives you the flexibility of virtualization without having to buy and maintain the physical hardware that runs it. However, you still need to maintain the VM by performing tasks such as configuring, patching, and installing the software that runs on it.</p>
                    <ul>
                        <li><strong>Scalability</strong> - Scale up or down based on demand</li>
                        <li><strong>Flexibility</strong> - Choose from hundreds of VM sizes</li>
                        <li><strong>Control</strong> - Full administrative access to your VMs</li>
                        <li><strong>Integration</strong> - Seamlessly integrate with other Azure services</li>
                    </ul>',
                    'tip' => 'Start with a smaller VM size and scale up as needed. This helps optimize costs while you learn.',
                ],
                [
                    'id' => 'creating-vm',
                    'title' => 'Creating Your First Virtual Machine',
                    'content' => '<p>Creating a virtual machine in Azure is straightforward. You can use the Azure Portal, Azure CLI, PowerShell, or ARM templates. In this tutorial, we will use the Azure Portal for a visual experience.</p>
                    <p>Before creating a VM, you need to consider:</p>
                    <ul>
                        <li><strong>Region</strong> - Choose a datacenter location close to your users</li>
                        <li><strong>Size</strong> - Select based on CPU, memory, and storage needs</li>
                        <li><strong>Image</strong> - Operating system (Windows or Linux)</li>
                        <li><strong>Authentication</strong> - SSH keys or password</li>
                    </ul>',
                    'code' => 'az vm create \\
    --resource-group myResourceGroup \\
    --name myVM \\
    --image Ubuntu2204 \\
    --admin-username azureuser \\
    --generate-ssh-keys',
                    'codeLanguage' => 'bash',
                ],
                [
                    'id' => 'vm-sizes',
                    'title' => 'Understanding VM Sizes and Series',
                    'content' => '<p>Azure offers a wide variety of VM sizes optimized for different workloads. Understanding these helps you choose the right size for your needs:</p>
                    <ul>
                        <li><strong>B-series</strong> - Burstable VMs ideal for workloads with variable CPU usage</li>
                        <li><strong>D-series</strong> - General purpose with balanced CPU-to-memory ratio</li>
                        <li><strong>E-series</strong> - Memory optimized for databases and caching</li>
                        <li><strong>F-series</strong> - Compute optimized for batch processing</li>
                        <li><strong>N-series</strong> - GPU enabled for AI/ML and graphics</li>
                    </ul>
                    <p>Each series has multiple sizes denoted by numbers (e.g., D2s_v3, D4s_v3) indicating the number of vCPUs.</p>',
                    'tip' => 'Use the "s" suffix VMs (like D2s_v3) for premium SSD storage support, which offers better performance.',
                ],
                [
                    'id' => 'networking',
                    'title' => 'Configuring VM Networking',
                    'content' => '<p>Every Azure VM is deployed into a Virtual Network (VNet) which provides network isolation and security. Understanding networking is crucial for proper VM deployment.</p>
                    <p>Key networking concepts:</p>
                    <ul>
                        <li><strong>Virtual Network</strong> - Isolated network for your Azure resources</li>
                        <li><strong>Subnet</strong> - Segment of your VNet for organizing resources</li>
                        <li><strong>Network Security Group (NSG)</strong> - Firewall rules for traffic control</li>
                        <li><strong>Public IP</strong> - Optional internet-facing IP address</li>
                        <li><strong>Private IP</strong> - Internal IP within the VNet</li>
                    </ul>',
                    'warning' => 'Never expose management ports (RDP 3389, SSH 22) directly to the internet. Use Azure Bastion or VPN for secure access.',
                    'code' => 'az network nsg rule create \\
    --resource-group myResourceGroup \\
    --nsg-name myNSG \\
    --name AllowHTTP \\
    --priority 100 \\
    --destination-port-ranges 80',
                    'codeLanguage' => 'bash',
                ],
                [
                    'id' => 'storage',
                    'title' => 'VM Storage Options',
                    'content' => '<p>Azure VMs use managed disks for storage. Understanding disk types helps optimize performance and cost:</p>
                    <ul>
                        <li><strong>OS Disk</strong> - Contains the operating system, required for every VM</li>
                        <li><strong>Temporary Disk</strong> - Fast local storage, data is lost on VM deallocation</li>
                        <li><strong>Data Disks</strong> - Additional disks for application data</li>
                    </ul>
                    <p>Disk performance tiers:</p>
                    <ul>
                        <li><strong>Standard HDD</strong> - Lowest cost, suitable for dev/test</li>
                        <li><strong>Standard SSD</strong> - Better performance, good for web servers</li>
                        <li><strong>Premium SSD</strong> - High performance for production workloads</li>
                        <li><strong>Ultra Disk</strong> - Highest performance for demanding applications</li>
                    </ul>',
                    'tip' => 'Enable disk caching (Read-only for OS disk, None for write-heavy data disks) to improve performance.',
                ],
                [
                    'id' => 'management',
                    'title' => 'Managing and Monitoring VMs',
                    'content' => '<p>Azure provides comprehensive tools for VM management and monitoring:</p>
                    <ul>
                        <li><strong>Azure Monitor</strong> - Collect and analyze metrics and logs</li>
                        <li><strong>VM Insights</strong> - Performance monitoring and dependency mapping</li>
                        <li><strong>Update Management</strong> - Automated patching and updates</li>
                        <li><strong>Backup</strong> - Automated backup with Azure Backup</li>
                        <li><strong>Disaster Recovery</strong> - Site Recovery for business continuity</li>
                    </ul>
                    <p>Best practices for VM management include regular backups, automated patching, and setting up alerts for critical metrics.</p>',
                    'code' => 'az vm list-usage --location eastus --output table',
                    'codeLanguage' => 'bash',
                ],
                [
                    'id' => 'cost-optimization',
                    'title' => 'Cost Optimization Strategies',
                    'content' => '<p>Optimize your Azure VM costs with these strategies:</p>
                    <ul>
                        <li><strong>Reserved Instances</strong> - Commit for 1-3 years and save up to 72%</li>
                        <li><strong>Spot VMs</strong> - Use spare capacity at up to 90% discount</li>
                        <li><strong>Auto-shutdown</strong> - Automatically stop VMs outside business hours</li>
                        <li><strong>Right-sizing</strong> - Regularly review and resize underutilized VMs</li>
                        <li><strong>Azure Hybrid Benefit</strong> - Use existing Windows Server licenses</li>
                    </ul>
                    <p>Use Azure Cost Management to track spending and set budgets for your VMs.</p>',
                    'tip' => 'Set up auto-shutdown schedules for development and test VMs to reduce costs by up to 70%.',
                ],
            ],
            'relatedServices' => [
                ['name' => 'VM Scale Sets', 'slug' => 'vm-scale-sets', 'tutorials' => 5],
                ['name' => 'App Service', 'slug' => 'app-service', 'tutorials' => 8],
                ['name' => 'Kubernetes Service', 'slug' => 'kubernetes-service', 'tutorials' => 10],
            ],
        ];
    }

    /**
     * App Service Tutorial Data
     */
    private static function getAppService(): array
    {
        return [
            'name' => 'App Service',
            'slug' => 'app-service',
            'category' => 'Compute',
            'description' => 'Build, deploy, and scale web apps with Azure App Service. A fully managed platform for hosting web applications.',
            'difficulty' => 'Beginner to Intermediate',
            'tutorials' => 8,
            'videoDuration' => '14:20',
            'iconUrl' => null,
            'videoThumbnail' => null,
            'videoUrl' => null,
            'sections' => [
                [
                    'id' => 'introduction',
                    'title' => 'Introduction to Azure App Service',
                    'content' => '<p>Azure App Service is a fully managed platform for building, deploying, and scaling web apps. You can host web apps, REST APIs, and mobile back ends.</p>
                    <ul>
                        <li><strong>Multiple Languages</strong> - Support for .NET, Java, Node.js, Python, PHP</li>
                        <li><strong>DevOps Integration</strong> - CI/CD with GitHub, Azure DevOps, Docker Hub</li>
                        <li><strong>Global Scale</strong> - Scale up or out with built-in load balancing</li>
                        <li><strong>Security</strong> - Built-in authentication and SSL certificates</li>
                    </ul>',
                    'tip' => 'Use deployment slots for zero-downtime deployments and easy rollbacks.',
                ],
                [
                    'id' => 'creating-app',
                    'title' => 'Creating Your First Web App',
                    'content' => '<p>Creating a web app in Azure App Service is quick and easy. You can deploy from source code, containers, or static files.</p>
                    <ul>
                        <li><strong>App Service Plan</strong> - Defines the region, scale, and pricing tier</li>
                        <li><strong>Runtime Stack</strong> - Choose your programming language and version</li>
                        <li><strong>Region</strong> - Select a location close to your users</li>
                    </ul>',
                    'code' => 'az webapp create \\
    --resource-group myResourceGroup \\
    --plan myAppServicePlan \\
    --name myUniqueAppName \\
    --runtime "NODE:18-lts"',
                    'codeLanguage' => 'bash',
                ],
                [
                    'id' => 'deployment',
                    'title' => 'Deployment Options',
                    'content' => '<p>Azure App Service supports multiple deployment methods:</p>
                    <ul>
                        <li><strong>Git Deploy</strong> - Push directly from local Git or GitHub</li>
                        <li><strong>ZIP Deploy</strong> - Upload a ZIP file with your application</li>
                        <li><strong>Docker</strong> - Deploy custom containers</li>
                        <li><strong>Azure DevOps</strong> - Full CI/CD pipeline integration</li>
                        <li><strong>GitHub Actions</strong> - Automated workflows from GitHub</li>
                    </ul>',
                    'tip' => 'Enable continuous deployment from GitHub for automatic deployments on every push.',
                ],
            ],
            'relatedServices' => [
                ['name' => 'Virtual Machines', 'slug' => 'virtual-machines', 'tutorials' => 12],
                ['name' => 'Functions', 'slug' => 'functions', 'tutorials' => 6],
                ['name' => 'Container Instances', 'slug' => 'container-instances', 'tutorials' => 5],
            ],
        ];
    }

    /**
     * Azure Functions Tutorial Data
     */
    private static function getFunctions(): array
    {
        return [
            'name' => 'Azure Functions',
            'slug' => 'functions',
            'category' => 'Compute',
            'description' => 'Build serverless applications with Azure Functions. Run event-driven code without managing infrastructure.',
            'difficulty' => 'Intermediate',
            'tutorials' => 6,
            'videoDuration' => '12:15',
            'iconUrl' => null,
            'videoThumbnail' => null,
            'videoUrl' => null,
            'sections' => [
                [
                    'id' => 'introduction',
                    'title' => 'Introduction to Azure Functions',
                    'content' => '<p>Azure Functions is a serverless compute service that lets you run event-triggered code without having to explicitly provision or manage infrastructure.</p>
                    <ul>
                        <li><strong>Event-Driven</strong> - Trigger functions from HTTP requests, timers, queues, and more</li>
                        <li><strong>Pay-per-Use</strong> - Only pay for the time your code runs</li>
                        <li><strong>Auto-Scale</strong> - Automatically scale based on demand</li>
                        <li><strong>Multiple Languages</strong> - C#, JavaScript, Python, Java, PowerShell</li>
                    </ul>',
                    'tip' => 'Use the Consumption plan for unpredictable workloads to minimize costs.',
                ],
                [
                    'id' => 'triggers',
                    'title' => 'Understanding Triggers and Bindings',
                    'content' => '<p>Triggers define how a function is invoked. Bindings provide a declarative way to connect to data.</p>
                    <ul>
                        <li><strong>HTTP Trigger</strong> - Invoke via HTTP requests (APIs, webhooks)</li>
                        <li><strong>Timer Trigger</strong> - Run on a schedule (cron expressions)</li>
                        <li><strong>Queue Trigger</strong> - Process messages from Azure Storage Queue</li>
                        <li><strong>Blob Trigger</strong> - React to new or updated blobs</li>
                        <li><strong>Event Hub Trigger</strong> - Process streaming data</li>
                    </ul>',
                    'code' => 'module.exports = async function (context, req) {
    context.log("HTTP trigger function processed a request.");

    const name = req.query.name || req.body?.name || "World";

    context.res = {
        body: `Hello, ${name}!`
    };
};',
                    'codeLanguage' => 'javascript',
                ],
            ],
            'relatedServices' => [
                ['name' => 'App Service', 'slug' => 'app-service', 'tutorials' => 8],
                ['name' => 'Logic Apps', 'slug' => 'logic-apps', 'tutorials' => 4],
                ['name' => 'Event Grid', 'slug' => 'event-grid', 'tutorials' => 3],
            ],
        ];
    }
}
