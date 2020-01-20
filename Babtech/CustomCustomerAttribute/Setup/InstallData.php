<?php

namespace Babtech\CUstomCustomerAttribute\Setup;

use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory, Config $eavConfig)
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig       = $eavConfig;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            Customer::ENTITY,
            'sample_attribute',
            [
                'type'         => 'varchar',
                'label'        => 'Custom Attribute',
                'input'        => 'text',
                'required'     => false,
                'visible'      => true,
                'user_defined' => true,
                'position'     => 999,
                'system'       => 0,
            ]
        );
        $sampleAttribute = $this->eavConfig->getAttribute(Customer::ENTITY, 'sample_attribute');
        $sampleAttribute->setData(
            'used_in_forms',
            ['adminhtml_checkout','adminhtml_customer','adminhtml_customer_address','customer_account_edit','customer_address_edit','customer_register_address']
        );
        $sampleAttribute->save();
        $eavSetup->addAttribute(
            Customer::ENTITY,
            'sample_attribute1',
            [
                'type'         => 'varchar',
                'label'        => 'Custom Another attribute',
                'input'        => 'text',
                'required'     => false,
                'visible'      => true,
                'user_defined' => true,
                'position'     => 999,
                'system'       => 0,
            ]
        );
        $sampleAttribute = $this->eavConfig->getAttribute(Customer::ENTITY, 'sample_attribute1');
        // more used_in_forms
        $sampleAttribute->setData(
            'used_in_forms',
            ['adminhtml_checkout','adminhtml_customer','adminhtml_customer_address','customer_account_edit','customer_address_edit','customer_register_address']
        );
        $sampleAttribute->save();
    }
}