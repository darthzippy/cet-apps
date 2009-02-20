class CreateSearches < ActiveRecord::Migration
  def self.up
    create_table :searches do |t|
      t.integer :department_id
      t.string :computer_type
      t.date :min_purdate
      t.date :max_purdate
      t.boolean :include_offinventory
      t.timestamps
    end
  end
  
  def self.down
    drop_table :searches
  end
end
