class AddHubIdToUser < ActiveRecord::Migration
  def self.up
    add_column :users, :hub_id, :integer
  end

  def self.down
    remove_column :users, :hub_id
  end
end
