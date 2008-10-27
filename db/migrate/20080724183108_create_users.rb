class CreateUsers < ActiveRecord::Migration
  def self.up
    create_table :users do |t|
      t.string :first
      t.string :middle
      t.string :last
      t.string :role
      t.string :building
      t.integer :room
      t.string :email
      t.string :phone
      t.string :barcode
      t.string :department
      t.string :active

      t.timestamps
    end
  end

  def self.down
    drop_table :users
  end
end
