// Azure Service Icons Library - Complete Edition
export function useAzureIcons() {
    const icons = {
        // Compute Icons
        'vm': { name: 'Virtual Machines', category: 'Compute', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="8" y="12" width="32" height="24" fill="#0078D4" rx="2"/><rect x="10" y="14" width="28" height="18" fill="#50E6FF"/></svg>' },
        'vm-scale-sets': { name: 'VM Scale Sets', category: 'Compute', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="6" y="10" width="12" height="10" fill="#0078D4" rx="1"/><rect x="18" y="10" width="12" height="10" fill="#50E6FF" rx="1"/><rect x="30" y="10" width="12" height="10" fill="#0078D4" rx="1"/></svg>' },
        'app-service': { name: 'App Service', category: 'Compute', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="10" y="10" width="28" height="28" fill="#0078D4" rx="2"/><path d="M18 20h12v2H18zm0 4h12v2H18z" fill="white"/></svg>' },
        'functions': { name: 'Functions', category: 'Compute', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path d="M20 12h8c2.2 0 4 1.8 4 4v4c0 2.2-1.8 4-4 4h-8c-2.2 0-4 1.8-4 4v4c0 2.2 1.8 4 4 4h8" stroke="#FFB900" stroke-width="3" fill="none"/></svg>' },
        'container': { name: 'Container Instances', category: 'Compute', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="12" y="12" width="24" height="24" fill="#0078D4" rx="2"/><rect x="15" y="15" width="18" height="18" fill="#50E6FF" rx="1"/></svg>' },
        'aks': { name: 'Kubernetes Service', category: 'Compute', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path d="M24 8l8 8v12l-8 8-8-8V16z" fill="#326CE5"/><circle cx="24" cy="24" r="6" fill="white"/></svg>' },
        'batch': { name: 'Batch', category: 'Compute', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="8" y="14" width="10" height="20" fill="#0078D4"/><rect x="19" y="10" width="10" height="28" fill="#50E6FF"/><rect x="30" y="18" width="10" height="16" fill="#0078D4"/></svg>' },
        'cloud-services': { name: 'Cloud Services', category: 'Compute', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path d="M36 26c0-2.2-1.8-4-4-4-.4 0-.8.1-1.2.2C30 18.3 27.3 16 24 16c-3.9 0-7 3.1-7 7 0 .3 0 .6.1.9C15.3 24.3 14 26 14 28c0 2.8 2.2 5 5 5h14c2.8 0 5-2.2 5-5z" fill="#0078D4"/></svg>' },
        
        // Storage Icons
        'storage-account': { name: 'Storage Accounts', category: 'Storage', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="10" y="14" width="28" height="6" fill="#0078D4"/><rect x="10" y="21" width="28" height="6" fill="#50E6FF"/><rect x="10" y="28" width="28" height="6" fill="#0078D4"/></svg>' },
        'blob': { name: 'Blob Storage', category: 'Storage', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><circle cx="24" cy="16" r="8" fill="#0078D4"/><circle cx="16" cy="28" r="6" fill="#50E6FF"/><circle cx="32" cy="28" r="6" fill="#50E6FF"/></svg>' },
        'file-storage': { name: 'File Storage', category: 'Storage', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path d="M14 10h14l6 6v22H14z" fill="#0078D4"/><path d="M28 10v6h6" fill="#50E6FF"/></svg>' },
        'queue': { name: 'Queue Storage', category: 'Storage', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="10" y="12" width="28" height="8" fill="#0078D4" rx="2"/><rect x="10" y="24" width="28" height="8" fill="#50E6FF" rx="2"/></svg>' },
        'table-storage': { name: 'Table Storage', category: 'Storage', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="10" y="12" width="28" height="24" fill="none" stroke="#0078D4" stroke-width="2"/><path d="M10 20h28M10 28h28M18 12v24M30 12v24" stroke="#0078D4" stroke-width="2"/></svg>' },
        'disk': { name: 'Managed Disks', category: 'Storage', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><circle cx="24" cy="24" r="16" fill="#0078D4"/><circle cx="24" cy="24" r="8" fill="#50E6FF"/><circle cx="24" cy="24" r="3" fill="#0078D4"/></svg>' },
        'data-lake': { name: 'Data Lake', category: 'Storage', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path d="M10 28c0-2 2-4 4-4h20c2 0 4 2 4 4v8H10z" fill="#50E6FF"/><path d="M14 24c0-2 2-4 4-4h12c2 0 4 2 4 4v4H14z" fill="#0078D4"/></svg>' },
        
        // Networking Icons
        'vnet': { name: 'Virtual Network', category: 'Networking', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><circle cx="24" cy="24" r="16" fill="none" stroke="#0078D4" stroke-width="2"/><circle cx="24" cy="12" r="3" fill="#0078D4"/><circle cx="36" cy="24" r="3" fill="#0078D4"/><circle cx="24" cy="36" r="3" fill="#0078D4"/><circle cx="12" cy="24" r="3" fill="#0078D4"/></svg>' },
        'vpn': { name: 'VPN Gateway', category: 'Networking', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path d="M24 8L12 18v12l12 10 12-10V18z" fill="#0078D4"/><path d="M24 18v14" stroke="white" stroke-width="2"/></svg>' },
        'load-balancer': { name: 'Load Balancer', category: 'Networking', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="20" y="10" width="8" height="6" fill="#0078D4" rx="1"/><rect x="10" y="28" width="8" height="6" fill="#50E6FF" rx="1"/><rect x="30" y="28" width="8" height="6" fill="#50E6FF" rx="1"/></svg>' },
        'app-gateway': { name: 'Application Gateway', category: 'Networking', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="10" y="20" width="28" height="8" fill="#0078D4" rx="2"/><path d="M16 20v-6M24 20v-6M32 20v-6M16 28v6M24 28v6M32 28v6" stroke="#50E6FF" stroke-width="2"/></svg>' },
        'traffic-manager': { name: 'Traffic Manager', category: 'Networking', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><circle cx="24" cy="16" r="4" fill="#0078D4"/><circle cx="12" cy="32" r="4" fill="#50E6FF"/><circle cx="24" cy="32" r="4" fill="#50E6FF"/><circle cx="36" cy="32" r="4" fill="#50E6FF"/></svg>' },
        'cdn': { name: 'CDN', category: 'Networking', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><circle cx="24" cy="24" r="16" fill="#0078D4"/><circle cx="24" cy="24" r="10" fill="#50E6FF"/><circle cx="24" cy="24" r="4" fill="white"/></svg>' },
        'azure-dns': { name: 'Azure DNS', category: 'Networking', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path d="M24 10l-12 8v12l12 8 12-8V18z" fill="#0078D4"/></svg>' },
        'firewall': { name: 'Firewall', category: 'Networking', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path d="M24 8l-12 6v8c0 7.4 5.1 14.3 12 16 6.9-1.7 12-8.6 12-16v-8z" fill="#D83B01"/><path d="M24 14v20M18 20h12M18 28h12" stroke="white" stroke-width="2"/></svg>' },
        'ddos': { name: 'DDoS Protection', category: 'Networking', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path d="M24 8l-12 6v8c0 7.4 5.1 14.3 12 16 6.9-1.7 12-8.6 12-16v-8z" fill="#0078D4"/><path d="M18 24l4 4 8-8" stroke="white" stroke-width="2" fill="none"/></svg>' },
        'express-route': { name: 'ExpressRoute', category: 'Networking', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="8" y="20" width="12" height="8" fill="#0078D4" rx="2"/><rect x="28" y="20" width="12" height="8" fill="#0078D4" rx="2"/><path d="M20 24h8" stroke="#FFB900" stroke-width="3"/></svg>' },
        'front-door': { name: 'Front Door', category: 'Networking', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="18" y="12" width="12" height="24" fill="#0078D4" rx="1"/><path d="M22 18h4M22 22h4" stroke="white" stroke-width="2"/><circle cx="24" cy="26" r="2" fill="#FFB900"/></svg>' },
        
        // Database Icons
        'sql': { name: 'SQL Database', category: 'Databases', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><ellipse cx="24" cy="14" rx="14" ry="6" fill="#0078D4"/><path d="M10 14v8c0 3.3 6.3 6 14 6s14-2.7 14-6v-8" fill="#50E6FF"/><path d="M10 22v8c0 3.3 6.3 6 14 6s14-2.7 14-6v-8" fill="#0078D4"/></svg>' },
        'sql-managed': { name: 'SQL Managed Instance', category: 'Databases', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><ellipse cx="24" cy="14" rx="14" ry="6" fill="#0078D4"/><path d="M10 14v8c0 3.3 6.3 6 14 6s14-2.7 14-6v-8" fill="#50E6FF"/><rect x="30" y="28" width="10" height="10" fill="#FFB900" rx="2"/></svg>' },
        'cosmos': { name: 'Cosmos DB', category: 'Databases', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><circle cx="24" cy="24" r="16" fill="#0078D4"/><ellipse cx="24" cy="24" rx="16" ry="6" fill="none" stroke="#50E6FF" stroke-width="2"/><ellipse cx="24" cy="24" rx="6" ry="16" fill="none" stroke="#50E6FF" stroke-width="2"/></svg>' },
        'mysql': { name: 'MySQL', category: 'Databases', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><ellipse cx="24" cy="16" rx="12" ry="5" fill="#00758F"/><path d="M12 16v10c0 2.8 5.4 5 12 5s12-2.2 12-5V16" fill="#00A4A6"/></svg>' },
        'postgresql': { name: 'PostgreSQL', category: 'Databases', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><ellipse cx="24" cy="16" rx="12" ry="5" fill="#336791"/><path d="M12 16v10c0 2.8 5.4 5 12 5s12-2.2 12-5V16" fill="#4A8BC2"/></svg>' },
        'mariadb': { name: 'MariaDB', category: 'Databases', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><ellipse cx="24" cy="16" rx="12" ry="5" fill="#003545"/><path d="M12 16v10c0 2.8 5.4 5 12 5s12-2.2 12-5V16" fill="#00657B"/></svg>' },
        'redis': { name: 'Redis Cache', category: 'Databases', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path d="M24 14l12 6v8l-12 6-12-6v-8z" fill="#DC382D"/><path d="M24 8l12 6-12 6-12-6z" fill="#C6302B"/></svg>' },
        
        // Analytics Icons
        'synapse': { name: 'Synapse Analytics', category: 'Analytics', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="10" y="20" width="8" height="16" fill="#0078D4"/><rect x="20" y="14" width="8" height="22" fill="#50E6FF"/><rect x="30" y="18" width="8" height="18" fill="#0078D4"/></svg>' },
        'databricks': { name: 'Databricks', category: 'Analytics', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path d="M24 8l-12 8v16l12 8 12-8V16z" fill="#FF3621"/><path d="M24 16l-8 5.3v10.7l8 5.3 8-5.3V21.3z" fill="white"/></svg>' },
        'data-factory': { name: 'Data Factory', category: 'Analytics', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="10" y="14" width="10" height="10" fill="#0078D4"/><rect x="28" y="14" width="10" height="10" fill="#0078D4"/><rect x="19" y="26" width="10" height="10" fill="#50E6FF"/></svg>' },
        'stream-analytics': { name: 'Stream Analytics', category: 'Analytics', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path d="M10 24h8l4-8 4 16 4-8h8" stroke="#0078D4" stroke-width="3" fill="none"/><circle cx="10" cy="24" r="2" fill="#50E6FF"/><circle cx="38" cy="24" r="2" fill="#50E6FF"/></svg>' },
        'power-bi': { name: 'Power BI Embedded', category: 'Analytics', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="12" y="22" width="6" height="14" fill="#F2C811"/><rect x="21" y="16" width="6" height="20" fill="#F2C811"/><rect x="30" y="12" width="6" height="24" fill="#F2C811"/></svg>' },
        'hdinsight': { name: 'HDInsight', category: 'Analytics', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><circle cx="18" cy="18" r="6" fill="#0078D4"/><circle cx="30" cy="18" r="6" fill="#50E6FF"/><circle cx="18" cy="30" r="6" fill="#50E6FF"/><circle cx="30" cy="30" r="6" fill="#0078D4"/></svg>' },
        
        // AI/ML Icons
        'ml': { name: 'Machine Learning', category: 'AI/ML', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path d="M12 12h8v8h-8zm16 0h8v8h-8zM12 28h8v8h-8zm16 0h8v8h-8z" fill="#0078D4"/><circle cx="24" cy="24" r="5" fill="#FFB900"/></svg>' },
        'openai': { name: 'Azure OpenAI', category: 'AI/ML', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><circle cx="24" cy="24" r="16" fill="#10A37F"/><path d="M24 12v24M12 24h24" stroke="white" stroke-width="3"/></svg>' },
        'cognitive': { name: 'Cognitive Services', category: 'AI/ML', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><circle cx="24" cy="18" r="8" fill="#0078D4"/><path d="M16 26c0-4.4 3.6-8 8-8s8 3.6 8 8v10H16z" fill="#50E6FF"/></svg>' },
        'bot-service': { name: 'Bot Service', category: 'AI/ML', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="12" y="18" width="24" height="18" fill="#0078D4" rx="4"/><circle cx="12" cy="12" r="3" fill="#50E6FF"/><circle cx="36" cy="12" r="3" fill="#50E6FF"/><circle cx="18" cy="26" r="2" fill="white"/><circle cx="30" cy="26" r="2" fill="white"/></svg>' },
        'computer-vision': { name: 'Computer Vision', category: 'AI/ML', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><circle cx="24" cy="24" r="14" fill="#0078D4"/><circle cx="24" cy="24" r="8" fill="#50E6FF"/><circle cx="24" cy="24" r="4" fill="white"/></svg>' },
        'speech': { name: 'Speech Services', category: 'AI/ML', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path d="M24 10c-4 0-7 3-7 7v6c0 4 3 7 7 7s7-3 7-7v-6c0-4-3-7-7-7z" fill="#0078D4"/></svg>' },
        'document-intelligence': { name: 'Document Intelligence', category: 'AI/ML', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="12" y="10" width="24" height="28" fill="#0078D4" rx="2"/><path d="M16 16h16M16 20h16M16 24h12M16 28h10" stroke="white" stroke-width="2"/></svg>' },
        'language-service': { name: 'Language Service', category: 'AI/ML', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="10" y="14" width="28" height="20" fill="#0078D4" rx="2"/><path d="M18 22h12M18 26h8" stroke="white" stroke-width="2"/></svg>' },
        
        // Security Icons
        'keyvault': { name: 'Key Vault', category: 'Security', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="14" y="20" width="20" height="18" fill="#0078D4" rx="2"/><path d="M18 20v-6c0-3.3 2.7-6 6-6s6 2.7 6 6v6" stroke="#0078D4" stroke-width="3" fill="none"/><circle cx="24" cy="29" r="3" fill="#FFB900"/></svg>' },
        'security-center': { name: 'Security Center', category: 'Security', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path d="M24 8l-12 6v8c0 7.4 5.1 14.3 12 16 6.9-1.7 12-8.6 12-16v-8z" fill="#0078D4"/><path d="M20 24l3 3 6-6" stroke="white" stroke-width="2" fill="none"/></svg>' },
        'sentinel': { name: 'Sentinel', category: 'Security', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path d="M24 8l-12 6v8c0 7.4 5.1 14.3 12 16 6.9-1.7 12-8.6 12-16v-8z" fill="#0078D4"/><circle cx="24" cy="24" r="6" fill="white"/></svg>' },
        'entra-id': { name: 'Microsoft Entra ID', category: 'Security', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><circle cx="24" cy="24" r="14" fill="#0078D4"/><path d="M24 14v20M14 24h20" stroke="white" stroke-width="2"/></svg>' },
        
        // DevOps Icons
        'azure-devops': { name: 'Azure DevOps', category: 'DevOps', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path d="M36 10l-24 4v20l24 4V10z" fill="#0078D4"/><circle cx="24" cy="24" r="6" fill="white"/></svg>' },
        'pipelines': { name: 'Pipelines', category: 'DevOps', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="10" y="14" width="8" height="8" fill="#0078D4" rx="1"/><rect x="30" y="14" width="8" height="8" fill="#0078D4" rx="1"/><rect x="20" y="26" width="8" height="8" fill="#50E6FF" rx="1"/></svg>' },
        'repos': { name: 'Repos', category: 'DevOps', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="12" y="10" width="24" height="28" fill="#0078D4" rx="2"/><circle cx="18" cy="18" r="3" fill="white"/><circle cx="30" cy="18" r="3" fill="white"/><circle cx="24" cy="30" r="3" fill="white"/></svg>' },
        'artifacts': { name: 'Artifacts', category: 'DevOps', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="10" y="10" width="28" height="28" fill="#0078D4" rx="2"/><rect x="14" y="14" width="20" height="20" fill="#50E6FF" rx="1"/></svg>' },
        'container-registry': { name: 'Container Registry', category: 'DevOps', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="10" y="10" width="28" height="28" fill="#0078D4" rx="2"/><rect x="14" y="14" width="20" height="20" fill="none" stroke="white" stroke-width="2"/></svg>' },
        'github-actions': { name: 'GitHub Actions', category: 'DevOps', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><circle cx="24" cy="24" r="14" fill="#2088FF"/><path d="M24 14l3 6 7 1-5 5 1 7-6-3-6 3 1-7-5-5 7-1z" fill="white"/></svg>' },
        
        // Integration Icons
        'service-bus': { name: 'Service Bus', category: 'Integration', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="10" y="20" width="28" height="8" fill="#0078D4" rx="2"/><circle cx="16" cy="14" r="3" fill="#50E6FF"/><circle cx="24" cy="14" r="3" fill="#50E6FF"/><circle cx="32" cy="14" r="3" fill="#50E6FF"/></svg>' },
        'event-grid': { name: 'Event Grid', category: 'Integration', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><circle cx="24" cy="24" r="4" fill="#0078D4"/><circle cx="12" cy="12" r="3" fill="#50E6FF"/><circle cx="36" cy="12" r="3" fill="#50E6FF"/><circle cx="12" cy="36" r="3" fill="#50E6FF"/><circle cx="36" cy="36" r="3" fill="#50E6FF"/></svg>' },
        'event-hubs': { name: 'Event Hubs', category: 'Integration', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><circle cx="24" cy="24" r="14" fill="#0078D4"/><circle cx="24" cy="24" r="8" fill="#50E6FF"/></svg>' },
        'logic-apps': { name: 'Logic Apps', category: 'Integration', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path d="M12 12h24v24H12z" fill="#0078D4"/><path d="M18 18l6 6-6 6M24 24h6" stroke="white" stroke-width="2" fill="none"/></svg>' },
        'api-management': { name: 'API Management', category: 'Integration', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="10" y="10" width="28" height="28" fill="#0078D4" rx="2"/><path d="M18 20h12M18 24h12M18 28h8" stroke="white" stroke-width="2"/></svg>' },
        
        // Monitoring Icons
        'azure-monitor': { name: 'Azure Monitor', category: 'Monitoring', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="10" y="30" width="4" height="8" fill="#0078D4"/><rect x="16" y="24" width="4" height="14" fill="#50E6FF"/><rect x="22" y="18" width="4" height="20" fill="#0078D4"/><rect x="28" y="22" width="4" height="16" fill="#50E6FF"/><rect x="34" y="26" width="4" height="12" fill="#0078D4"/></svg>' },
        'app-insights': { name: 'Application Insights', category: 'Monitoring', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path d="M10 32l6-8 6 4 6-12 6 8 6-4" stroke="#0078D4" stroke-width="3" fill="none"/></svg>' },
        'alerts': { name: 'Alerts', category: 'Monitoring', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path d="M24 10l-10 18h20z" fill="#D83B01"/><path d="M24 20v6M24 28v2" stroke="white" stroke-width="2"/></svg>' },
        'log-analytics': { name: 'Log Analytics', category: 'Monitoring', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="10" y="12" width="28" height="24" fill="#0078D4" rx="2"/><path d="M14 18h20M14 22h20M14 26h16M14 30h12" stroke="white" stroke-width="1.5"/></svg>' },
        
        // IoT Icons
        'iot-hub': { name: 'IoT Hub', category: 'IoT', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><circle cx="24" cy="24" r="8" fill="#0078D4"/><circle cx="12" cy="16" r="3" fill="#50E6FF"/><circle cx="36" cy="16" r="3" fill="#50E6FF"/><circle cx="12" cy="32" r="3" fill="#50E6FF"/><circle cx="36" cy="32" r="3" fill="#50E6FF"/></svg>' },
        'iot-central': { name: 'IoT Central', category: 'IoT', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><circle cx="24" cy="24" r="14" fill="#0078D4"/><circle cx="24" cy="24" r="6" fill="white"/></svg>' },
        
        // Default
        'default': { name: 'Default Service', category: 'General', svg: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><rect x="12" y="12" width="24" height="24" fill="#0078D4" rx="2"/><path d="M20 20h8v8h-8z" fill="white"/></svg>' }
    };

    const getIcon = (identifier) => {
        return icons[identifier] || icons['default'];
    };

    const getAllIcons = () => {
        return Object.entries(icons).map(([key, value]) => ({
            id: key,
            ...value
        }));
    };

    const getIconsByCategory = () => {
        const grouped = {};
        Object.entries(icons).forEach(([key, value]) => {
            const category = value.category || 'General';
            if (!grouped[category]) {
                grouped[category] = [];
            }
            grouped[category].push({ id: key, ...value });
        });
        return grouped;
    };

    return {
        icons,
        getIcon,
        getAllIcons,
        getIconsByCategory
    };
}
