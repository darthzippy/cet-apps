class CreateLicenses < ActiveRecord::Migration
  def self.up
    create_table :licenses do |t|
      t.integer :user_id
      t.integer :software_id

      t.timestamps
    end
  end

  def self.down
    drop_table :licenses
  end
end
