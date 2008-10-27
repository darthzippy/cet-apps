class RemoveUserIdFromHubs < ActiveRecord::Migration
  def self.up
    remove_column :hubs, :user_id
    remove_column :hubs, :check_in
    remove_column :hubs, :check_out
    remove_column :users, :hub_id
  end

  def self.down
  end
end
