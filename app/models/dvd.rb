class Dvd < ActiveRecord::Base
  
  def self.search(search, page)
    paginate :per_page => 15, :page => page,
             :conditions => ['lastname like ? OR phone like ?', "%#{search}%", "%#{search}%"],
             :order => 'lastname'
  end
end
