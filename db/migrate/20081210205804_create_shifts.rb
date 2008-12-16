class CreateShifts < ActiveRecord::Migration
  def self.up
    create_table :shifts do |t|
      t.integer :cet_user_id
      t.integer :payperiod_id
      t.datetime :start_time
      t.datetime :end_time

      t.timestamps
    end
  end

  def self.down
    drop_table :shifts
  end
end
