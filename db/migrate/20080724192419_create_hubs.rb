class CreateHubs < ActiveRecord::Migration
  def self.up
    create_table :hubs do |t|
      t.integer :hub_number
      t.datetime :check_out
      t.datetime :check_in
      t.integer :user_id

      t.timestamps
    end
  end

  def self.down
    drop_table :hubs
  end
end
