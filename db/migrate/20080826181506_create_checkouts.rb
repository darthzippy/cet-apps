class CreateCheckouts < ActiveRecord::Migration
  def self.up
    create_table :checkouts do |t|
      t.integer :user_id
      t.integer :hub_id
      t.datetime :checkout
      t.datetime :checkin

      t.timestamps
    end
  end

  def self.down
    drop_table :checkouts
  end
end
