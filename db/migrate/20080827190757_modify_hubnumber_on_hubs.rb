class ModifyHubnumberOnHubs < ActiveRecord::Migration
  def self.up
    change_column :hubs, :hub_number, :string
  end

  def self.down
    change_column :hubs, :hub_number, :integer
  end
end
