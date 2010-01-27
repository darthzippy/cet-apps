class CreateComputers < ActiveRecord::Migration
  def self.up
    create_table :computers do |t|
      t.string :control
      t.string :serial
      t.string :model
      t.string :manufacturer
      t.date :purchase_date
      t.integer :purchase_price
      t.string :purchase_acct
      t.string :status
      t.string :cstatus
      t.integer :memory
      t.integer :hard_drive
      t.string :updated_by

      t.timestamps
    end
  end

  def self.down
    drop_table :computers
  end
end
