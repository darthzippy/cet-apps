class DropHubsTable < ActiveRecord::Migration
  def self.up
  end

  def self.down
    drop_table :hubs
    drop_table :checkouts
  end
end
