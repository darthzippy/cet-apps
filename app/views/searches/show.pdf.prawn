pdf.font "Helvetica"

pdf.text "CET Apps Custom Search Report", :size => 24, :style => :bold
pdf.text "Created at #{Time.now.to_formatted_s(:long)} by #{current_cet_user.display_name}"

pdf.move_down(10)

items = @search.computers.map do |item|
  [
    item.control,
	item.serial,
	item.model,
	item.departments.try(:name),
	item.user.try(:fullname),
	item.status,
	item.try(:maintenance_fee)
  ]
end

pdf.table items,
  :row_colors => ["FFFFFF", "DDDDDD"],
  :headers => ["Control", "Serial", "Model", "Department", "User", "Status", "Fee"]