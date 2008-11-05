class AddMoreLegacyColumnsToComputers < ActiveRecord::Migration
  def self.up
    add_column :computers, :needupgrade, :string
    add_column :computers, :legacy_purchase_date, :string
    add_column :computers, :override, :string
    add_column :computers, :warranty_type, :string
    add_column :computers, :os_campagree, :string
    add_column :computers, :off_campagree, :string
    add_column :computers, :legacy_account_old, :string
  end

  def self.down
    remove_column :computers, :legacy_account_old
    remove_column :computers, :off_campagree
    remove_column :computers, :os_campagree
    remove_column :computers, :warranty_type
    remove_column :computers, :override
    remove_column :computers, :legacy_purchase_date
    remove_column :computers, :needupgrade
  end
end
