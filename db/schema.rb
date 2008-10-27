# This file is auto-generated from the current state of the database. Instead of editing this file, 
# please use the migrations feature of Active Record to incrementally modify your database, and
# then regenerate this schema definition.
#
# Note that this schema.rb definition is the authoritative source for your database schema. If you need
# to create the application database on another system, you should be using db:schema:load, not running
# all the migrations from scratch. The latter is a flawed and unsustainable approach (the more migrations
# you'll amass, the slower it'll run and the greater likelihood for issues).
#
# It's strongly recommended to check this file into your version control system.

ActiveRecord::Schema.define(:version => 20080905173226) do

  create_table "cet_users", :force => true do |t|
    t.string   "login"
    t.string   "email"
    t.string   "display_name"
    t.string   "given_name"
    t.datetime "last_login_at"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "checkouts", :force => true do |t|
    t.integer  "user_id",    :limit => 11
    t.integer  "hub_id",     :limit => 11
    t.datetime "checkout"
    t.datetime "checkin"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "hubs", :force => true do |t|
    t.string   "hub_number"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "licenses", :force => true do |t|
    t.integer  "user_id",     :limit => 11
    t.integer  "software_id", :limit => 11
    t.datetime "created_at"
    t.datetime "updated_at"
    t.string   "updated_by"
  end

  create_table "softwares", :force => true do |t|
    t.string   "name"
    t.string   "software_type"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "users", :force => true do |t|
    t.string   "first"
    t.string   "middle"
    t.string   "last"
    t.string   "role"
    t.string   "building"
    t.integer  "room",       :limit => 11
    t.string   "email"
    t.string   "phone"
    t.string   "barcode"
    t.string   "department"
    t.string   "active"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.integer  "gordon_id",  :limit => 11
    t.string   "on_campus"
  end

end
