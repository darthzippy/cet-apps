class CreateDvds < ActiveRecord::Migration
  def self.up
    create_table :dvds do |t|
      t.string :firstname
      t.string :lastname
      t.string :address1
      t.string :address2
      t.string :city
      t.string :state
      t.string :zip
      t.string :email
      t.string :phone
      t.integer :quantity
      t.string :pickup
      t.boolean :paid
      t.date :paid_date
      t.string :paid_with
      t.boolean :delivered
      t.timestamps
    end
  end

  def self.down
    drop_table :dvds
  end
end
