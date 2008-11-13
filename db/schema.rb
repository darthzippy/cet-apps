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

ActiveRecord::Schema.define(:version => 20081113192500) do

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
    t.integer  "user_id"
    t.integer  "hub_id"
    t.datetime "checkout"
    t.datetime "checkin"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "comments", :force => true do |t|
    t.integer  "computer_id"
    t.text     "body"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "computers", :force => true do |t|
    t.string   "control"
    t.string   "serial"
    t.string   "model"
    t.string   "manufacturer"
    t.date     "purchase_date"
    t.integer  "purchase_price"
    t.string   "purchase_acct"
    t.string   "status"
    t.string   "cstatus"
    t.integer  "memory"
    t.integer  "hard_drive"
    t.string   "updated_by"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.string   "legacy_user"
    t.string   "legacy_department"
    t.string   "legacy_account"
    t.integer  "purchase_month"
    t.integer  "purchase_day"
    t.integer  "purchase_year"
    t.integer  "warranty_length"
    t.integer  "warranty_end"
    t.text     "comment"
    t.integer  "charge"
    t.string   "legacy_userid"
    t.string   "location"
    t.integer  "nuend"
    t.integer  "nuyear"
    t.integer  "numonth"
    t.integer  "nuday"
    t.integer  "endyear"
    t.integer  "endday"
    t.integer  "endmonth"
    t.integer  "nozero"
    t.string   "legacy_dateupdated"
    t.string   "legacy_userupdated"
    t.string   "wishmaketype"
    t.integer  "repprioroty"
    t.integer  "busflag"
    t.string   "puracct_old"
    t.string   "controlyear"
    t.string   "codedate"
    t.string   "legacy_primaryuser"
    t.string   "lookup"
    t.string   "needupgrade"
    t.string   "legacy_purchase_date"
    t.string   "override"
    t.string   "warranty_type"
    t.string   "os_campagree"
    t.string   "off_campagree"
    t.string   "legacy_account_old"
    t.string   "computer_type"
  end

  create_table "departments", :force => true do |t|
    t.string   "name"
    t.string   "maintenance_account"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "hardware_assignments", :force => true do |t|
    t.integer  "computer_id"
    t.integer  "user_id"
    t.integer  "department_id"
    t.boolean  "primary_computer"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "hubs", :force => true do |t|
    t.string   "hub_number"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "licenses", :force => true do |t|
    t.integer  "user_id"
    t.integer  "software_id"
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
    t.integer  "room"
    t.string   "email"
    t.string   "phone"
    t.string   "barcode"
    t.string   "department"
    t.string   "active"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.integer  "gordon_id"
    t.string   "on_campus"
  end

end
