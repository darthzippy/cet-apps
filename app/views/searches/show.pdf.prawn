pdf.font "Helvetica"

pdf.text "CET Apps Custom Search Report", :size => 24, :style => :bold
pdf.text "Created at #{Time.now.to_formatted_s(:long)} by #{current_cet_user.display_name}"

pdf.move_down(10)

items = @search.computers.map do |item|
  [
    item.control,
	item.serial,
	item.model,
	item.purchase_date
  ]
end

pdf.table items,
  :row_colors => ["FFFFFF", "DDDDDD"],
  :headers => ["Control", "Serial", "Model", "Purchase Date"]